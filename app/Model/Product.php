<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends BaseModel
{

    protected $table = 'product';
    protected $fillable = ['bar_code', 'brand_name', 'model_no', 'name', 'details', 'features', 'introduction', 'specification', 'origin', 'warranty', 'is_private', 'unit_of_measure_id', 'main_category_id', 'master_category_id', 'sub_category_id'];

    /**
     * MODEL RELATIONS
     */


    public function masterCategory()
    {
        return $this->belongsTo(ProductCategories::class, 'master_category_id');
    }

    public function mainCategory()
    {
        return $this->belongsTo(ProductCategories::class, 'main_category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(ProductCategories::class, 'sub_category_id');
    }

    public function unitMeasure()
    {
        return $this->belongsTo(UnitOfMeasure::class, 'unit_of_measure_id');
    }

    /**
     * Retrieve all list of translations for the product type column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'product');
    }

    public function fieldValueTranslator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'value', 'name');
    }

    public function translator()
    {
        return $this->fieldValueTranslator()->where('table', '=', 'product');
    }

    public function businessProduct()
    {
        return $this->hasOne(\App\Model\Business\BusinessProduct::class, 'product_id');
    }

    public function keyword()
    {
        return $this->hasMany(ProductKeywords::class, 'product_id', 'id');
    }

    public function media()
    {
        return $this->hasMany(\App\Model\ProductMedia::class, 'product_id', 'id');
    }
}
