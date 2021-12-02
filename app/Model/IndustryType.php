<?php

namespace App\Model;

use App\Model\BusinessLists;
use App\Model\IndustryCategory;

class IndustryType extends BaseModel
{
    protected $table = 'industry_type';
    protected $guarded = ['id'];

    /**
	 * MODEL RELATIONS
     */

    public function businesses()
    {
        return $this->hasMany(Business::class, 'industry_type_id');
    }

    public function industryCategory()
    {
        return $this->hasMany(IndustryCategory::class, 'industryTypeID');
    }

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'industry_type');
    }

    /**
     * Retrieve all list of translations for the industry type column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'industry_type');
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
