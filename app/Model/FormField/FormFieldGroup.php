<?php

namespace App\Model\FormField;
use App\Model\FieldValueTranslator;
class FormFieldGroup extends \App\Model\BaseModel
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

    /**
     * Retrieve list of form fields under this category
     * 
     * */
    public function formFields()
    {
        return $this->hasMany(FormField::class, 'form_field_group_id');
    }

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'form_field_groups');
    }

    /**
     * Retrieve all list of translations for the industry type column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'form_field_groups');
    }

    /**
     * Retrieve the name translation data of the name field column of the industry type table
     *
     * @return ActiveQuery
     */
    public function nameTranslation()
    {
        return $this->translator()->where('field', 'name');
    }

    /** 
     * Retrieve the translation of the description column
     *
     * @return ActiveQuery 
     */
    public function descriptionTranslation()
    {
        return $this->translator()->where('field', 'description');
    }
}
