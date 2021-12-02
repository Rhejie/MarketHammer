<?php

namespace App\Model;
use App\Model\FieldValueTranslator;

use Illuminate\Database\Eloquent\Model;

class OperationCondition extends \App\Model\BaseModel
{
    protected $fillable = ['name', 'description'];

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'operation_conditions');
    }

    /**
     * Retrieve all list of translations for the industry type column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'operation_conditions');
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
