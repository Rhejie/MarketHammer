<?php

namespace App\Model\FormTemplate;

class BuyerFormTemplate extends \App\Model\BaseModel
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
     * Create a one to one relationship to form template status table
     *
     * @return <ActiveQuery>
     */
    public function status()
    {
        return $this->belongsTo(FormTemplateStatus::class, 'form_template_status_id');
    }

    /**
     * Retrieve the user who recently updated a model
     *
     * @return <ActiveQuery>
     */
    public function updatedByUser()
    {
        return $this->belongsTo(\App\Model\User::class, 'updated_by')->select(['id', 'email'])->displayName();
    }

    /**
     * Template form groups. These are the categories or divisions in the template
     * 
     * @return <ActiveQuery>
     */
    public function templateFormGroups()
    {
        return $this->hasMany(TemplateFormGroup::class, 'buyer_form_template_id');
    }

    /**
     * Template form fields. These are the fields in the template 
     * 
     * @return <ActiveQuery>
     */
    public function templateFormFields()
    {
        return $this->hasMany(TemplateFormField::class,  'buyer_form_template_id');
    }

    /**************************
      E N D  R E L A T I O N S
    **************************/
}