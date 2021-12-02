<?php

namespace App\Http\Requests\BackOffice\BusinessLevel;

use Illuminate\Foundation\Http\FormRequest;

class StoreBusinessLevel extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'level' => 'required|integer',
            'description' => 'nullable|string',
            'created_at' => 'required|date',
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
            $this->getDefault(['required', 'string', 'integer', 'date'])
        );

        return $messages;
    }
}
