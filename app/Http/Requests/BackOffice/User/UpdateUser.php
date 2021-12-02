<?php

namespace App\Http\Requests\BackOffice\User;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class UpdateUser extends BaseRequest
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
            'user_type_id' => 'required|integer',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => [
                'required',
                Rule::unique('users')->ignore($this->id) 
            ],
            'phone' => 'nullable|string',
            'image_path' => 'nullable|string',
            'birth_day' => 'nullable|string',
            'updated_at' => 'required|date',
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
            $this->getDefault(['required', 'integer', 'string', 'date', 'in', 'unique'])
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
        ]);
    }
}
