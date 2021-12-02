<?php

namespace App\Repositories\Rfq;

use App\Model\FormFieldAnswer;
use App\Repositories\Repository;
use Illuminate\Support\Facades\DB;
use App\Repositories\Buyer\FormSubmissionFieldRepository;
use App\Model\FormSubmissionField;
use App\Repositories\FormField\FormFieldRepository;
use App\Model\FormField\FormField;

class FormFieldAnswerRepository extends Repository
{
    public function __construct(FormFieldAnswer $model)
    {
        parent::__construct($model);
        $this->formSubmissionFieldRepository = new FormSubmissionFieldRepository(new FormSubmissionField);
        $this->formFieldRepository = new FormFieldRepository(new FormField);
    }

    /**
     * Override parent create functionality.
     *
     * @param $data <array> - post inforation
     *
     * @return <object || boolean>
     */
    public function saveAnswer(array $data)
    {
        \DB::beginTransaction();
        try {
            $success = true;
            $toSubmit = isset($data['to_submit']) && $data['to_submit'] ? true : false;
            if(isset($data['field_answer_list'])){
                $toLinkData = array();
                $supplier_id = null;
                foreach ($data['field_answer_list'] as $field) {
                    $modelToSave = null;
                    if(isset($field['id'])){
                        $getAnswerModel = FormFieldAnswer::find($field['id']);
                        if($getAnswerModel){
                            $getAnswerModel->updated_at = __utc_time_now();
                            $getAnswerModel->updated_by = auth()->user()->id;
                            $getAnswerModel->value = $field['value'];

                            if (!$getAnswerModel->save()) {
                                $success = false;
                            }else{
                                $modelToSave = $getAnswerModel;
                            }
                        }
                    }
                    else{
                        $answerModel = new FormFieldAnswer;
                        $answerModel->form_submission_to_supplier_id = $field['form_submission_to_supplier_id'];
                        $answerModel->form_submission_form_field_id = $field['form_submission_form_field_id'];
                        $answerModel->buyer_id = $field['buyer_id'];
                        $answerModel->supplier_id = $field['supplier_id'];
                        $answerModel->created_at = __utc_time_now();
                        $answerModel->created_by = auth()->user()->id;
                        $answerModel->value = $field['value'];

                        if (!$answerModel->save()) {
                            $success = false;
                        }else{
                            $modelToSave = $answerModel;
                        }
                    }

                    //Save to link
                    if($success && $toSubmit && $modelToSave){
                        $setDataToLink = $this->setDataToLink($modelToSave);
                        if($setDataToLink){
                            $table = $setDataToLink['table_name'];
                            $column = $setDataToLink['table_column'];
                            $value = $setDataToLink['value'];
                            if(!isset($toLinkData[$table])) { $toLinkData[$table] = array(); }

                            $toLinkData[$table][$column] = $value;
                            
                        }
                        $supplier_id = $modelToSave->supplier_id;
                    }
                    
                }
                if($success && $toSubmit && $supplier_id){
                    $this->insertEntries($toLinkData, $supplier_id);
                }
                

            }

            if ($success) {
                \DB::commit();
                return true;
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return false;
    }


    public function setDataToLink($answerModel){

        if($answerModel->value){
            $answerValue = $answerModel->value;
            //Get submission field
            $getField = $this->formSubmissionFieldRepository->get($answerModel->form_submission_form_field_id);
            if($getField && $getField->is_link_to_table){
                //Matrix is to insert new row
                $getPropertyValueType = $this->formFieldRepository->getPropertyFieldType($getField->field_type, 'value_type');

                if($getPropertyValueType == 'single') {
                    if($getField->table_name && $getField->table_column){
                        $checkColExist = __check_table_column_exist($getField->table_name, $getField->table_column);

                        if($checkColExist){
                            $isNewEntry = $this->formFieldRepository->getPropertyTable($getField->table_name, 'is_new_entry');
                            if($isNewEntry){
                                return ['table_name' => $getField->table_name, 'table_column' => $getField->table_column, 'value' => $answerValue];
                            }

                            $dataColumn = [$getField->table_column => $answerValue];
                            $this->saveToDB($answerModel->supplier_id, $getField->table_name, $dataColumn);
                        }
                        
                    }
                    
                }
                else if($getPropertyValueType == 'matrix') {

                    if($getField->table_name){
                        $answerValue = json_decode($answerValue);
                        $toSaveAnswer = [];
                        $getBusinessColumn = $this->getBusinessColumn($getField->table_name);
                        if($getBusinessColumn){
                            foreach ($answerValue as $key => $val) {
                                $toSave = (array)$val;
                                if(isset($toSave['_idKey_'])){ 
                                    unset($toSave['_idKey_']);
                                }
                                if($getBusinessColumn){
                                    $toSave[$getBusinessColumn] = $answerModel->supplier_id;
                                }

                                $toSaveData = array();
                                foreach ($toSave as $col => $data) {
                                    $checkColExist = __check_table_column_exist($getField->table_name, $col);
                                    if($checkColExist){
                                        $toSaveData[$col] = $data;
                                    }
                                }
                                array_push($toSaveAnswer, $toSaveData);

                            }
                        }

                        DB::table($getField->table_name)->insert($toSaveAnswer);
                    }
                }
            }
        }
        return null;
        
    }

    public function insertEntries($list, $supplier_id){
        try {
            foreach ($list as $table => $tableData) {
                $business_id_column = $this->getBusinessColumn($table);
                $getData = DB::table($table)->where([$business_id_column => $supplier_id])->first();
                //If has no existing data with this business, insert new entry
                if(!$getData){
                    $tableData[$business_id_column] = $supplier_id;
                    DB::table($table)->insert($tableData);
                }
            }
        }
        catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

    }

    public function saveToDB($supplier_id, $table, $dataColumn){

        $business_id_column = $this->getBusinessColumn($table);

        if($business_id_column){
            $getRow = DB::table($table)->where($business_id_column, $supplier_id)->first();
            if($getRow){
                $data = DB::table($table)
                  ->where('id', $getRow->id)
                  ->update($dataColumn);
            }
            
        }
    }

    public function getBusinessColumn($table){

        $business_id_column = null;
        $getTableColumns = __get_table_columns($table);
        if(in_array('business_id', $getTableColumns)){
            $business_id_column = 'business_id';
        }
        else if(in_array('supplier_id', $getTableColumns)){
            $business_id_column = 'supplier_id';
        }
        return $business_id_column;
    }

}