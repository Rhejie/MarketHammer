<?php

namespace App\Model\FormTemplate;

class TemplateFormGroup extends \App\Model\BaseModel
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
     * Form fields added under a form group in a buyer template
     *  
     * @return <ActiveQuery>
     */
    public function formFields()
    {
        return $this->hasMany(TemplateFormField::class, 'template_form_group_id');
    }

    /**
     * Retrieve the form field group relation of this template field group 
     * 
     * @return <ActiveQuery>
     */
    public function formFieldGroup()
    {
        return $this->belongsTo(\App\Model\FormField\FormFieldGroup::class, 'form_field_group_id');
    }

    /**************************
      E N D  R E L A T I O N S
    **************************/
}