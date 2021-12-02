<?php

namespace App\Http\Requests\BackOffice\FormField;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;
use App\Repositories\FormField\FormFieldRepository;

class StoreFormField extends BaseRequest
{
    public function __construct(FormFieldRepository $formFieldRepository)
    {
        $this->formFieldRepository = $formFieldRepository;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'form_field_group_id' => 'required|integer',
            'field_label' => [
                'required',
                'string',
                Rule::unique('form_fields')->where(function ($q) {
                    $q->where('field_label', $this->field_label)
                    ->whereNull('deleted_at');
                })
            ],
            'field_type' => 'required|string',
            'field_description' => 'nullable|string'
        ];
    }

    /**
     * Will do additional custom validtion. This will be executed 
     * after the initial validation is done running
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateOptions($validator);
        });
    }

    /**
     * Validate if there is a valid options. This validation will check if there is a valid option
     * in the request. If the ``type`` field id equals to ``option`` then this validation will check the request.
     *
     * @param $validator <object> - the fully contructed validator instance
     */
    public function validateOptions($validator)
    {
        $options = $this->request->get('field_options');
        $repo = $this->formFieldRepository;

        if ($this->request->get('source_table') == null) {
            if(!!$options && $this->request->get('field_type') !== "Matrix"){
                $valid = array_reduce($options, function ($acc, $cur) {
                    return $acc = $cur['value'] && $cur['label'] ? true : false;
                }, false);
    
                if (!$valid) {
                    $validator->errors()->add('field_options', __('No valid options'));
                }
            }       
        }
        else if ($this->request->get('source_table') != null) 
        {
            $options = null;
        }

        if ($this->request->get('is_link_to_table') == 1) {
            $tableName = $this->request->get('table_name');
            $tableColumn = $this->request->get('table_column');

            /* Matrix type is from matrix option list */
            if($this->request->get('field_type') !== "Matrix"){

                if (!$tableName || !$repo->checkIfTableAndColumnExist($tableName, $tableColumn, true)) {
                    $validator->errors()->add('table_name', __('Invalid table name.'));
                }

                if (!$tableColumn || !$repo->checkIfTableAndColumnExist($tableName, $tableColumn)) {
                    $validator->errors()->add('table_column', __('Invalid table column.'));
                }
            }
        }
    }
}
