<?php

namespace App\Model\Business;

use App\Model\BaseModel;
use Illuminate\Support\Facades\Validator;

class BusinessSns extends BaseModel
{
	/**
	 * Set the table that this model will be manipulating
	 */
	protected $table = 'business_sns';

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
        	'business_id' => 'required|integer',
        	'sns_id' => 'required|integer',
        	'account_info' => 'required|string',
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

    /*********************
      R E L A T I O N S
    *********************/
    /**
     * Establish one to one relation for role table
     *
     * @return \App\Models\Role
     */
    public function sns()
    {
        return $this->belongsTo(\App\Model\Setting\SnsList::class, 'sns_id');
    }
    /**************************
      E N D  R E L A T I O N S
    **************************/
}
