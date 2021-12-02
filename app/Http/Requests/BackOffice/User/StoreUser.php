<?php

namespace App\Http\Requests\BackOffice\User;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class StoreUser extends BaseRequest
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
                'email',
                Rule::unique('users')->where(function ($q) {
                    $q->where('email', $this->email)
                    ->whereNull('deleted_at');
                })
            ],
            'phone' => 'nullable|string',
            'password' => 'required|string',
            'image_path' => 'nullable|string',
            'created_from_social' => 'required|string',
            'birth_day' => 'nullable|string',
            'is_confirmed' => [
                'required',
                Rule::in([1, 0])
            ],
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
        $password = $this->password ? bcrypt($this->password) : bcrypt(12341234);

        $this->merge([
            'is_confirmed' => $this->is_confirmed ? $this->is_confirmed : 0,
            'password' => $password,
            'created_from_social' => $this->created_from_social ?: 'regular',
            'created_at' => __utc_time_now()->format('Y-m-d H:i:s'),
        ]);
    }
}
