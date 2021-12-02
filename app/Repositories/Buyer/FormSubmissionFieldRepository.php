<?php

namespace App\Repositories\Buyer;

use App\Repositories\Repository;
use App\Model\FormSubmissionField;
use App\Repositories\FormField\FormFieldRepository;
use Illuminate\Support\Facades\DB;
use App\Model\FormField\FormField;

class FormSubmissionFieldRepository extends Repository
{
	public function __construct(FormSubmissionField $model)
    {
        parent::__construct($model);
        $this->formFieldRepository = new FormFieldRepository(new FormField);
    }

    /**
     * Override parent create functionality.
     *
     * @param $data <array> - post inforation
     *
     * @return <object || boolean>
     */
    public function create(array $data)
    {
        \DB::beginTransaction();
        try {
            $model = new $this->model;
            $model->form_submission_id = $data['form_submission_id'];
            $model->form_submission_group_id = $data['form_submission_group_id'];
            $model->field_label = $data['field_label'];
            $model->field_type = $data['field_type'];
            $model->field_description = $data['field_description'];
            $model->field_options = $data['field_options'] ? $data['field_options'] : null;
            $model->is_link_to_table = $data['is_link_to_table'];
            $model->source_table = $data['source_table'];
            $model->table_name = $data['table_name'];
            $model->table_column = $data['table_column'];
            $model->is_required = isset($data['is_required']) ? $data['is_required'] : false;
            $model->is_added_to_template = isset($data['is_added_to_template']) ? $data['is_added_to_template'] : false;
            $model->field_settings = isset($data['field_settings']) ? $data['field_settings'] : null;
            $model->created_by = auth()->user()->id;
            $model->created_at = __utc_time_now();
            if(isset($data['field_original_options'])){
                $model->field_options = $data['field_original_options'];
            }

            if ($model->save()) {
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                \DB::commit();

                return $this->get($model->id);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return false;
    }

    /**
     * Override parent update functionality.
     *
     * @param $id <int>
     * @param $data <array>
     *
     * @return <object || boolean>
     */
    public function update(array $data, $id)
    {
        $model = $this->get($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $model->form_submission_id = $data['form_submission_id'];
                $model->form_submission_group_id = $data['form_submission_group_id'];
                $model->field_label = $data['field_label'];
                $model->field_type = $data['field_type'];
                $model->field_description = $data['field_description'];
                $model->field_options = $data['field_options'] ? $data['field_options'] : null;
                $model->is_link_to_table = $data['is_link_to_table'];
                $model->source_table = $data['source_table'];
                $model->table_name = $data['table_name'];
                $model->table_column = $data['table_column'];
                $model->is_required = isset($data['is_required']) ? $data['is_required'] : false;
            	$model->is_added_to_template = isset($data['is_added_to_template']) ? $data['is_added_to_template'] : false;
                $model->field_settings = isset($data['field_settings']) ? $data['field_settings'] : null;
                $model->updated_by = auth()->user()->id;
                $model->updated_at = __utc_time_now();
                if(isset($data['field_original_options'])){
                    $model->field_options = $data['field_original_options'];
                }

                if ($model->save()) {
                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    return $this->get($model->id);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }


    public function getFormFields($params){
        $fieldsList = $this->model();

        if(isset($params->form_submission_id)){
            $fieldsList = $fieldsList->where(['form_submission_fields.form_submission_id' => $params->form_submission_id]);
        }

        if(isset($params->form_submission_group_id)){
            $fieldsList = $fieldsList->where(['form_submission_fields.form_submission_group_id' => $params->form_submission_group_id]);
        }

        if(isset($params->supplier_id)){
            $supplier_id = $params->supplier_id;

            // if(isset($params->form_submission_to_suppliers_id)) {
            //     $form_submission_to_suppliers_id = $params->form_submission_to_suppliers_id ? $params->form_submission_to_suppliers_id : null ;
            // }

            $fieldsList = $fieldsList->select([
                'form_submission_fields.*',
                'form_field_answers.value as field_answer_value',
                'form_field_answers.id as field_answer_id',
            ])
            ->leftJoin('form_submission_to_suppliers', function ($join) use ($supplier_id){
                $join->on('form_submission_fields.form_submission_id', '=', 'form_submission_to_suppliers.form_submission_id')
                ->where('form_submission_to_suppliers.supplier_id', '=', $supplier_id)
                ->whereNull('form_submission_to_suppliers.deleted_at');
                // if($form_submission_to_suppliers_id) {
                //     $join->where('form_submission_to_suppliers.supplier_id', '=',  $form_submission_to_suppliers_id);
                // }
            })
            ->leftJoin('form_field_answers', function ($join) {
                $join->on('form_submission_fields.id', '=', 'form_field_answers.form_submission_form_field_id')
                ->where('form_submission_to_suppliers.id', '=', DB::raw("form_field_answers.form_submission_to_supplier_id"));
            });
        }


        $fieldsList = $fieldsList->get()->toArray();

        foreach ($fieldsList as $key => $field) {
            $fieldsList[$key]['field_original_options'] = $field['field_options'];

            $getPropertyType = $this->formFieldRepository->getPropertyFieldType($field['field_type']);
            if($getPropertyType == 'option'){

                if(isset($field['source_table']) && $field['field_options'] == null){
                    $optionList = $this->formFieldRepository->optionFromDatabase($field['source_table']);
                    $fieldsList[$key]['field_options'] = $optionList;
                }
            }

            elseif($getPropertyType == 'matrix'){
                $columns = (array) $field['field_options'];
                if(count($columns) > 0){
                    foreach ($columns as $keyCol => $cols) {
                        $cols = (array)$cols;
                        if(isset($cols['type'])){
                            $colPropertyType = $this->formFieldRepository->getPropertyFieldType($cols['type']);
                            if($colPropertyType == 'option'){

                                $type_option = isset($cols['type_option']) ? (array)$cols['type_option'] : null;
                                if($type_option){
                                    if(isset($type_option['source_table']) &&
                                        ($type_option['field_options'] == null || count($type_option['field_options']) == 0) ){
                                        $colOptionList = $this->formFieldRepository->optionFromDatabase($type_option['source_table']);
                                        $type_option['field_options'] = $colOptionList;
                                    }
                                    $cols['field_options'] = $type_option['field_options'];
                                }
                            }
                            $columns[$keyCol] = $cols;
                        }
                    }
                }
                $fieldsList[$key]['field_options'] = $columns;
            }


            $field_settings = (array)$field['field_settings'];
            $defaultValue = $field_settings && isset($field_settings['defaultValue']) ? $field_settings['defaultValue'] : null;
            $hasAnswerData = isset($field['field_answer_id']) && $field['field_answer_id'] ? true : false;

            $getPropertyValueType = $this->formFieldRepository->getPropertyFieldType($field['field_type'], 'value_type');
            $getPropertyValue = $this->formFieldRepository->getPropertyFieldType($field['field_type'], 'value');

            if($getPropertyValueType == 'multiple') {
                if($hasAnswerData && isset($field['field_answer_value'])) {
                    $value_decode = json_decode($field['field_answer_value']);
                    if(isset($value_decode->values)) {
                        $fieldsList[$key]['field_answer_value'] = $value_decode->values;
                    }
                    else{
                        $fieldsList[$key]['field_answer_value'] = [];
                    }
                }
                else if($defaultValue){
                    $fieldsList[$key]['field_answer_value'] = isset($defaultValue->values) && is_array($defaultValue->values) ? $defaultValue->values : [];

                }else{
                    $fieldsList[$key]['field_answer_value'] = [];
                }
            }

            elseif($getPropertyValueType == 'matrix'){
                if(isset($field['field_answer_value']) ) {
                    $value_decode = json_decode($field['field_answer_value']);
                    $fieldsList[$key]['field_answer_value'] = $value_decode;
                }
                else if($defaultValue){
                    $fieldsList[$key]['field_answer_value'] = is_array($defaultValue) ? $defaultValue : [];
                }else{
                    $fieldsList[$key]['field_answer_value'] = [];
                }
            }
            elseif($getPropertyValue == 'Single Checkbox'){ //For Single Checkbox, it will be true/false
                $checkBoxVal = null;
                if(isset($field['field_answer_value']) ) {
                    $checkBoxVal = $field['field_answer_value'];
                }
                else if($defaultValue){
                    $checkBoxVal = $defaultValue;
                }
                $fieldsList[$key]['field_answer_value_orignal'] = $checkBoxVal;

                if(!$checkBoxVal || $checkBoxVal === '0' || $checkBoxVal === 'false'){
                    $fieldsList[$key]['field_answer_value'] = false;
                }
                else{
                    $fieldsList[$key]['field_answer_value'] = true;
                }

            }
            else{

                if(isset($field['field_answer_value'])) {
                    $fieldsList[$key]['field_answer_value'] = $field['field_answer_value'];
                }
                else if($defaultValue){
                    $fieldsList[$key]['field_answer_value'] = $defaultValue;
                }else{
                    $fieldsList[$key]['field_answer_value'] = null;
                }

            }
        }

        return $fieldsList;
    }
}
