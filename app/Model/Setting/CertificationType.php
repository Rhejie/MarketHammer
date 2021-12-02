<?php

namespace App\Model\Setting;
use App\Model\FieldValueTranslator;

class CertificationType extends \App\Model\BaseModel
{
    protected $table = 'certification_type';
    protected $guarded = ['id'];

    /**
	 * MODEL RELATIONS
     */

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'certification_type');
    }

    /**
     * Retrieve all list of translations for the industry type column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'certification_type');
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
