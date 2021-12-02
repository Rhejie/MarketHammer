<?php

namespace App\Model;

class ComplexType extends \App\Model\BaseModel
{
    //
    protected $fillable = ['name', 'description'];

    public function businessList()
    {

        return $this->hasMany(Business::class);
    }

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'complex_types');
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
