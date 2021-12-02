<?php

namespace App\Http\Requests\BackOffice\FormField;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class UpdateFormField extends BaseRequest
{
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
                Rule::unique('form_fields')
                ->ignore($this->id)
                ->where(function ($q) {
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

        if ($this->request->get('source_table') == null && !!$options && $this->request->get('field_type') !== "Matrix") {
            $valid = array_reduce($options, function ($acc, $cur) {
                return $acc = $cur['value'] && $cur['label'] ? true : false;
            }, false);

            if (!$valid) {
                $validator->errors()->add('field_options', __('No valid options'));
            }
        }
    }
}
