<?php

namespace App\Http\Requests\BackOffice\Business\BusinessFinance;

use App\Http\Requests\BaseRequest;

class UpdateBusinessFinance extends BaseRequest
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
            'business_id' => 'required|integer',
            'year' => 'required|date_format:Y',
            'revenue' => 'required|numeric',
            'ebit' => 'required|numeric',
            'updated_at' => 'required|date'
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
            $this->getDefault(['required', 'string', 'date'])
        );

        return $messages;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'updated_at' => __utc_time_now()->format('Y-m-d H:i:s')
        ]);
    }
}
