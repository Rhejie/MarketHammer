<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QSAList extends Model
{
    use SoftDeletes;
    
    protected $table = 'qsa_list';

    /**
	 * MODEL RELATIONS
     */

    public function qsaType() {
        return $this->belongsTo(QSAType::class, 'qsa_type_id');
    }

    public function businessQsa()
    {
        return $this->hasOne(\App\Model\Business\BusinessQsa::class, 'qsa_detail_id');
    }

    /**
     * Retrieve all list of translations for the qsa_list columns
     *
     * @return ActiveQuery
     */
    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'qsa_list');
    }

    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'qsa_list');
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
