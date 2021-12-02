<?php

namespace App\Http\Requests\BackOffice\Business\BusinessCertification;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class UpdateBusinessCertification extends BaseRequest
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
            'certification_id' => 'required|integer',
            'certification_no' => 'nullable|string',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'is_verified' => [
                'required',
                Rule::in([1, 0])
            ],
            'issued_date' => 'required|date|before_or_equal:expiry_date',
            'expiry_date' => 'required|date|after_or_equal:issued_date',
            'updated_at' => 'required|date',
            'deleted_at' => 'nullable|date',
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
            $this->getDefault(['required', 'integer', 'string', 'date', 'in']),
            $this->buildMessages(['issued_date'], 'before_or_equal', ['after_field' => __('expiration date')]),
            $this->buildMessages(['expiry_date'], 'after_or_equal', ['before_field' => __('issued date')])
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
            'updated_at' => __utc_time_now()->format('Y-m-d H:i:s'),
            'is_verified' => $this->is_verified ? $this->is_verified : 0,
            'business_id' => json_decode($this->business_id),
            'certification_id' => json_decode($this->certification_id)
        ]);
    }
}
