<?php

namespace App\Http\Requests\BackOffice\Cluster;

use App\Http\Requests\BaseRequest;

class StoreClusterRequest extends BaseRequest
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
            'code' => 'required|unique:clusters,code,NULL,id,deleted_at,NULL',
            'name' => 'required|unique:clusters,name,NULL,id,deleted_at,NULL',
            'countryId' => 'required'
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
