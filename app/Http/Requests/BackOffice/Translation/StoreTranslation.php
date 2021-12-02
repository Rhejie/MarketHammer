<?php

namespace App\Http\Requests\BackOffice\Translation;

use App\Http\Requests\BaseRequest;

class StoreTranslation extends BaseRequest
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
            'key' => 'required|string',
            'en' => 'required|string',
            'ko' => 'nullable|string',
            'zh' => 'nullable|string',
            'jp' => 'nullable|string',
            'de_de' => 'nullable|string',
            'created_at' => 'required|date'
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
            $this->getDefault(['required', 'string', 'date', 'in', 'email'])
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
            'created_at' => __utc_time_now()->format('Y-m-d H:i:s')
        ]);
    }
}
