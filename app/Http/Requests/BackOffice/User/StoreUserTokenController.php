<?php

namespace App\Http\Requests\BackOffice\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserTokenController extends FormRequest
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
            'access_token' => 'required|string',
            'refresh_token' => 'nullable|string',
            'expires_at' => 'required|date'
        ];
    }
}
