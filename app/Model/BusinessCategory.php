<?php

namespace App\Model;

use Illuminate\Support\Facades\Validator;

class BusinessCategory extends BaseModel
{
    protected $table = 'business_category';
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
            'name.required' => 'Business Category Name is required.',
            'industry_type_id.required' => 'Industry Type field is required.',
            'created_at.required' => 'Created At field is required.',
        ];

        $validator = Validator::make($this->attributes, [
            'industry_type_id' => 'required|integer',
            'master_business_category_id' => 'nullable|integer',
            'main_business_category_id' => 'nullable|integer',
            'sub_business_category_id' => 'nullable|integer',
            'ko_stat_code' => 'nullable|string',
            'tax_code' => 'nullable|string',
            'sic_code' => 'nullable|string',
            'name' => 'required|string',
            'description' => 'nullable|string',
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

    public function assignedCategory()
    {
        return $this->hasMany(AssignedCategories::class, 'categoryID');
    }

    public function industryType()
    {
        return $this->belongsTo(IndustryType::class, 'industry_type_id');
    }

    public function masterParent()
    {
        return $this->belongsTo(BusinessCategory::class, 'master_business_category_id');
    }

    public function mainParent()
    {
        return $this->belongsTo(BusinessCategory::class, 'main_business_category_id');
    }

    public function subParent()
    {
        return $this->belongsTo(BusinessCategory::class, 'sub_business_category_id');
    }

    public function translator()
    {
        return $this->hasOne(FieldValueTranslator::class, 'table_id')->where('table', 'business_category');
    }

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

    /**
     * ACCESSORS
     */

    // public function getIndustryNamesAttribute() {
    //     $industryNames = [];

    //     $industryNames = IndustryCategory::with('industry')->where('categoryID', $this->id)->get();
    //     $industryNames = $industryNames->pluck('industry.name');

    //     return $industryNames;
    // }

    // public function getIndustryIdsAttribute() {
    //     $industryIds = [];

    //     $industryIds = IndustryCategory::with('industry')->where('categoryID', $this->id)->get();
    //     $industryIds = $industryIds->pluck('industry.id');

    //     return $industryIds;
    // }

    /* public function getChildrenAttribute() {

        $categories = BusinessCategory::with('children.children.children.children')->where('parentCategoryID', $this->id)->get();

        return $categories ? $categories : [];
    } */

    /* public function getIndustryNameAttribute() {

        $industryName = IndustryCategory::with('industryType')->where('categoryID', $this->id)->first();

        return $industryName ? $industryName->industryType->name : null;
    }

    public function getIndustryIdAttribute() {
        $industryId = IndustryCategory::with('industryType')->where('categoryID', $this->id)->first();

        return $industryId ? $industryId->industryType->id : null;
    }

    public function getIndustryIdsAttribute() {
        $industryIds = IndustryCategory::with('industryType')->where('categoryID', $this->id)->pluck('industryTypeID');

        return $industryIds ? $industryIds : null;
    }

    public function getIndustryTypeNamesAttribute() {
        $industryIds = IndustryCategory::with('industryType')->where('categoryID', $this->id)->pluck('industryTypeID')->toArray();

        $industryNames = IndustryType::whereIn('id', $industryIds)->pluck('name');
        // dd($industryNames);
        return $industryNames ? $industryNames : null;
    }*/
}
