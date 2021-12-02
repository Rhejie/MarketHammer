<?php

namespace App\Http\Requests\BackOffice\Product\ProductKeyword;

use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class UpdateProductKeywordRequest extends BaseRequest
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
            'name' => "required|unique:product_keywords,name,$this->id,id,deleted_at,NULL",
            'product_id' => 'required|integer',
            'color' => 'nullable|string',
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
