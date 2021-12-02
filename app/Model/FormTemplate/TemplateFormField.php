<?php

namespace App\Model\FormTemplate;

class TemplateFormField extends \App\Model\BaseModel
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

    /*********************
      R E L A T I O N S
    *********************/

     /**
     * Retrieve the form field relation of this template field field 
     * 
     * @return <ActiveQuery>
     */
    public function formField()
    {
        return $this->belongsTo(\App\Model\FormField\FormField::class, 'form_field_id');
    }

    /**************************
      E N D  R E L A T I O N S
    **************************/
}