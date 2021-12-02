<?php

namespace App\Http\Requests\Backoffice;

use App\Http\Requests\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\BaseRequest;

class ProductRequest extends BaseRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => [ 
                'required',
                //Rule::unique('product')->ignore($this->id, 'id')
            ]
        ];
    }

    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        /*$messages = array_merge(
            $this->getDefault(['required', 'unique'])
        );*/

        $messages = [];

        return $messages;
    }
}
