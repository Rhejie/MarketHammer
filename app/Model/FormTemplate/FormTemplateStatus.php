<?php

namespace App\Model\FormTemplate;

class FormTemplateStatus extends \App\Model\BaseModel
{
	/**
     * Specify attribute here if you want it to not be mass 
     * assinable. By default all attributes are mass assinable.
     *
     * @var <array>
     */
    protected $guarded = [];

    /**
     * Remove updated_at as auto managed by laravel
     */
    const UPDATED_AT = null;
}