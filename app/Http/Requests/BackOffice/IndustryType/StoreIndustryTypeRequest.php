<?php

namespace App\Http\Requests\BackOffice\IndustryType;

use App\Http\Requests\BaseRequest;

class StoreIndustryTypeRequest extends BaseRequest
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
            'name' => 'required|unique:industry_type,name,NULL,id,deleted_at,NULL'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        $messages = array_merge(
            $this->getDefault(['required', 'unique'])
        );

        return $messages;
    }
}
