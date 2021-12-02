<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategories extends Model
{
    use SoftDeletes;
    
    protected $table = 'product_categories';
     /**
     * Specify attribute here if you want it to not be mass 
     * assinable. By default all attributes are mass assinable.
     *
     * Every attribute is mass assignable
     *
     * @var <array>
     */
    protected $guarded = [];

    /**
     * Will hold MessageBag from validation
     */
    public $errors = null;

    /**
     * Custom validator
     *
     * @return <array | boolean>
     */
    public function validate()
    {
        $messages = $messages = [
            'name.required' => 'Product Category Name is required.',
            'created_at.required' => 'Created At field is required.',
        ];

        $validator = Validator::make($this->attributes, [
            'name' => 'required|string',
            'created_at' => 'required|date',
            'updated_at' => 'nullable|date',
            'deleted_at' => 'nullable|date'
        ], $messages);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }

        $this->errors = null;
        return true;
    }

    /**
	 * MODEL RELATIONS
     */

    /**
     * Retrieve all list of translations for the industry type column
     *
     * @return ActiveQuery
     */
    public function translations()
    {
        return $this->hasMany(FieldValueTranslator::class, 'table_id')->where('table', 'product_categories');
    }

    public function masterChild() {
        return $this->hasMany(ProductCategories::class, 'master_product_category_id');
    }

    public function mainChild() {
        return $this->hasMany(ProductCategories::class, 'main_product_category_id');
    }

    public function masterParent() {
        return $this->belongsTo(ProductCategories::class, 'master_product_category_id');
    }

    public function mainParent() {
        return $this->belongsTo(ProductCategories::class, 'main_product_category_id');
    }

    public function subParent() {
        return $this->belongsTo(ProductCategories::class, 'sub_product_category_id');
    }
}
