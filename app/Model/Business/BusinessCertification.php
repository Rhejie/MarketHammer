<?php

namespace App\Model\Business;

use App\Model\BaseModel; 
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BusinessCertification extends BaseModel
{
	/**
	 * Set the table that this model will be manipulating
	 */
	protected $table = 'business_certification';

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
    
    /*********************
      R E L A T I O N S
    *********************/
    /**
     * Get business certification medias
     *
     * @return \App\Models\Business\BusinessCertification
     */
    public function medias()
    {
        return $this->hasMany(BusinessCertificationMedia::class);
    }
    /**************************
      E N D  R E L A T I O N S
    **************************/
}