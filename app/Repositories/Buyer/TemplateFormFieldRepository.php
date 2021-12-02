<?php

namespace App\Repositories\Buyer;

use App\Repositories\Repository;
use App\Model\FormTemplate\{TemplateFormField, TemplateFormGroup};
use App\Repositories\FormField\FormFieldRepository;
use App\Model\FormField\FormField;

class TemplateFormFieldRepository extends Repository
{
	public function __construct(TemplateFormField $model)
    {
        parent::__construct($model);
        $this->formFieldRepository = new FormFieldRepository(new FormField);
    }

    public function getFormFields($params){
        $fieldsList = $this->model()->with(['formField.translations'])
        ->whereHas('formField');

        if(isset($params->template_form_group_id)){
            $fieldsList = $fieldsList->where(['template_form_fields.template_form_group_id' => $params->template_form_group_id]);
        }
        if(isset($params->buyer_form_template_id)){
            $fieldsList = $fieldsList->where(['template_form_fields.buyer_form_template_id' => $params->buyer_form_template_id]);
        }

        $fieldsList = $fieldsList->get()->toArray();

        foreach ($fieldsList as $key => $fieldTemplate) {
            $field = $fieldTemplate['form_field'];
            if($field){
                $fieldsList[$key]['form_field']['field_original_options'] = $field['field_options'];
                $getPropertyType = $this->formFieldRepository->getPropertyFieldType($field['field_type']);
                if($getPropertyType == 'option'){

                    if(isset($field['source_table']) && $field['field_options'] == null){
                        $optionList = $this->formFieldRepository->optionFromDatabase($field['source_table']);
                        $fieldsList[$key]['form_field']['field_options'] = $optionList;
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
                    $fieldsList[$key]['form_field']['field_options'] = $columns;
                }

                $getPropertyValueType = $this->formFieldRepository->getPropertyFieldType($field['field_type'], 'value_type');
                $getPropertyValue = $this->formFieldRepository->getPropertyFieldType($field['field_type'], 'value');

                //Set field_answer_value
                if($getPropertyValueType == 'multiple' || $getPropertyValueType == 'matrix') {
                    $fieldsList[$key]['form_field']['field_answer_value'] = [];
                }
                else if($getPropertyValue == 'Single Checkbox') {
                    $fieldsList[$key]['form_field']['field_answer_value'] = false;
                }
                else{
                    $fieldsList[$key]['form_field']['field_answer_value'] = null;
                }
            }
        }

        return $fieldsList;
    }

    
}