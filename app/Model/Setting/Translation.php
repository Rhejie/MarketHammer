<?php

namespace App\Model\Setting;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
	/**
     * Remove updated_at as auto managed by laravel
     */
    const UPDATED_AT = null;

    /**
     * Remove updated_at as auto managed by laravel
     */
    const DELETED_AT = null;

  	/**
     * Specify attribute here if you want it to not be mass 
     * assinable. By default all attributes are mass assinable.
     *
     * @var <array>
     */
    protected $guarded = [];
}