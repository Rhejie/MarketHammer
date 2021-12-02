<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductKeywords extends Model
{
    use SoftDeletes;
    
    protected $table = 'product_keywords';
    protected $guarded = ['id'];

    /**
     * MODEL RELATIONS
     */

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function fieldValueTranslator() {
        return $this->hasOne(FieldValueTranslator::class, 'value', 'name');
    }

    public function translator() {
        return $this->fieldValueTranslator()->where('table','=', 'product_keywords');
    }

    /**
     * Retrieve all list of translations for the product keyword type column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'product_keywords');
    }
}
