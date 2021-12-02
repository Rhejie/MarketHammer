<?php

namespace App\Http\Requests\BackOffice\Keyword;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StoreGlobalKeyword extends BaseRequest
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
            'name' => [
                'required',
                'string',
                Rule::unique('global_keywords')->where(function ($query) {
                    if (!$this->from_id && !$this->from) {
                        $query->where(['from' => null, 'from_id' => null]);
                    } else {
                        $query->where(['from' => $this->from, 'from_id' => $this->from_id]);
                    }
                })
            ],
            'lang_ko' => 'nullable|string',
            'lang_zh' => 'nullable|string',
            'lang_jp' => 'nullable|string',
            'lang_de_de' => 'nullable|string',
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
            'created_by' => auth()->user()->id,
            'created_at' => __utc_time_now()->format('Y-m-d H:i:s')
        ]);
    }
}
