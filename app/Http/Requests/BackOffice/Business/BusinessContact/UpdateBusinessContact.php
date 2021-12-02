<?php

namespace App\Http\Requests\BackOffice\Business\BusinessContact;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class UpdateBusinessContact extends BaseRequest
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
            'name' => 'required|string',
            'title' => 'nullable|string',
            'role_id' => 'nullable|integer',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'fax' => 'nullable|string',
            'is_president' => [
                'required',
                Rule::in([1, 0])
            ],
            'is_primary' => [
                'required',
                Rule::in([1, 0])
            ],
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
            $this->getDefault(['required', 'integer', 'string', 'date', 'in', 'email'])
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
