<?php

namespace App\Model\Business;

use App\Model\BaseModel;
use Illuminate\Support\Facades\Validator;

class BusinessFinance extends BaseModel
{
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
}