<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\FieldValueTranslator;

class SupplierStatus extends \App\Model\BaseModel
{
    protected $fillable = ['name'];

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'supplier_statuses');
    }

    /**
     * Retrieve all list of translations for the industry type column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'supplier_statuses');
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

    public function businessFollowers()
    {
        return $this->hasMany(\App\Model\Business\BusinessFollower::class);
    }
}
