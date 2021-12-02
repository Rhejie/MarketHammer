<?php

namespace App\Model\Business;

use App\Model\BaseModel; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BusinessCertificationMedia extends BaseModel
{
	/**
	 * Set the table that this model will be manipulating
	 */
	protected $table = 'business_certification_media';

	/**
     * Remove updated_at as auto managed by laravel
     */
    const UPDATED_AT = null;

  	/**
     * Specify attribute here if you want it to not be mass 
     * assinable. By default all attributes are mass assinable.
     *
     * @var <array>
     */
    protected $guarded = [];
    
 	/**
     * Custom validator
     *
     * @return <array | boolean>
     */
    public function validate()
    {
        $validator = Validator::make($this->attributes, [
        	'business_certification_id' => 'required|integer',
        	'media_type' => 'required|string',
        	'media_url' => 'required|string',
        	'created_at' => 'required|date',
        	'updated_at' => 'nullable|date',
        	'deleted_at' => 'nullable|date',
       	]);

        if ($validator->fails()) {
        	$this->errors = $validator->errors();
            return false;
        }

        $this->errors = null;
        return true;
    }
}