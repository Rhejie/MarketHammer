<?php

namespace App\Model;

use App\Model\Business\BusinessMaterial;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\DataTranslationQuery;

class Material extends Model
{
    use SoftDeletes, DataTranslationQuery;

    protected $table = 'material';
    protected $guarded = ['id'];

    /**
     * MODEL RELATIONS
     */

    public function materialType()
    {
        return $this->belongsTo(MaterialType::class, 'material_type_id');
    }

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'material');
    }

    /**
     * Retrieve all list of translations for the industry type column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'material');
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
    
    public function businessMaterial()
    {
        return $this->hasMany(BusinessMaterial::class, 'id', 'material_id');
    }
}
