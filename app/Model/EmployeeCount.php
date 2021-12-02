<?php

namespace App\Model;

class EmployeeCount extends \App\Model\BaseModel
{
    protected $table = 'employee_count';
    protected $guarded = ['id'];

    /**
	 * MODEL RELATIONS
     */

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'employee_count');
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
