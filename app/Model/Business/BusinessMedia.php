<?php

namespace App\Model\Business;

use App\Model\BaseModel;
use Illuminate\Support\Facades\Validator;

class BusinessMedia extends BaseModel
{
    /**
     * Set the table that this model will be manipulating
     */
    protected $table = 'business_medias';

	/**
     * Remove updated_at as auto managed by laravel
     */
    const UPDATED_AT = null;

    /*********************
      R E L A T I O N S
    *********************/
    /**
     * Establish one to one relation for role table
     *
     * @return \App\Models\Role
     */
    public function business()
    {
        return $this->belongsTo(\App\Model\Business::class);
    }
    /**************************
      E N D  R E L A T I O N S
    **************************/
}