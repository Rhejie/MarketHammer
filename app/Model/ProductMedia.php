<?php

namespace App\Model;

use App\Model\BaseModel;
use Illuminate\Support\Facades\Validator;

class ProductMedia extends BaseModel
{
    /**
     * Set the table that this model will be manipulating
     */
    protected $table = 'product_media';

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
    public function product()
    {
        return $this->belongsTo(\App\Model\Product::class);
    }
    /**************************
      E N D  R E L A T I O N S
    **************************/
}