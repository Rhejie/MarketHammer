<?php

namespace App\Repositories\Category;

use App\Helpers\ListHelper;
use App\Model\BusinessCategory;
use App\Model\ClusterCategory;
use App\Model\IndustryCategory;
use App\Model\IndustryType;
use App\Repositories\Repository;

class BusinessCategoryRepository extends Repository
{
    public function __construct(BusinessCategory $model)
    {
        parent::__construct($model);
    }

    /**
     * Will fetch list of business category, this function will also paginate
     * the return data if $params is present
     *
     * @param $params <null | object> - filter return data
     *
     * @return <array>
     */
    public function getCategoryList($params = null)
    {
        $categories = [];

        if ($params) {
            $categories = $this->model;
            if (isset($params->search)) {
                $categories = $categories->with(['translations']);
                $categories = $categories->where(function ($query) use ($params) {
                        $query->orWhere('name', 'LIKE', "%$params->search%");
                        $query->orWhereHas('nameTranslation', function ($query2) use ($params) {
                            $query2->where(function ($query3) use ($params) {
                                $query3->orWhere('lang_en', 'LIKE', "%$params->search%");
                                $query3->orWhere('lang_ko', 'LIKE', "%$params->search%");
                                $query3->orWhere('lang_jap', 'LIKE', "%$params->search%");
                            });
                        });
                    });
            }
            else{
                $categories = $categories->with(['masterParent', 'mainParent', 'subParent', 'industryType', 'translations']);
            }
            $categories = $categories->orderBy('id', 'ASC');

            //Type: Master, Main, Sub, Detail
            if (isset($params->type)) {
                //Get the last category
                if ($params->type == 'detail') {
                    $categories = $categories->whereNotNull('master_business_category_id')
                        ->whereNotNull('main_business_category_id')
                        ->whereNotNull('sub_business_category_id')
                        ->with(['translations']);
                } else if ($params->type == 'master') {
                    $categories = $categories->whereNull('master_business_category_id')
                        ->whereNull('main_business_category_id')
                        ->whereNull('sub_business_category_id')
                        ->with(['translations']);
                }
            }

            if (isset($params->count)) {
                $categories = $categories->paginate($params->count);
            } else {
                $categories = $categories->get()->toArray();
            }
        } else {
            $categories = BusinessCategory::with(['masterParent', 'mainParent', 'subParent', 'industryType',  'translations'])->orderBy('id', 'ASC')->get()->toArray();
        }

        return $categories;
    }

    /**
     * Will create a new business category.
     *
     * @param $params <object> - post data to save
     *
     * @return <array>
     */
    public function storeCategory($params)
    {
        $attributes['name'] = strtolower($params['name']);
        $attributes['description'] = $params['description'];
        $attributes['industry_type_id'] = $params['industry_type_id'];
        $attributes['master_business_category_id'] = $params['master_business_category_id'];
        $attributes['main_business_category_id'] = $params['main_business_category_id'];
        $attributes['sub_business_category_id'] = $params['sub_business_category_id'];
        $attributes['ko_stat_code'] = $params['ko_stat_code'];
        $attributes['tax_code'] = $params['tax_code'];
        $attributes['sic_code'] = $params['sic_code'];

        \DB::beginTransaction();
        try {
            $category = $this->model;
            $category->fill($attributes);
            $category->created_at = auth()->user()->utcTimeNow();

            if (!$category->validate()) return ['success' => false, 'errors' => $category->errors];

            $success = $category->save();

            if ($success) {
                \DB::commit();
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($category);
                }
                $category = $this->model::where('id', $category->id)
                    ->select()
                    ->with(['industryType', 'translations'])
                    ->first()->toArray();

                return ['success' => true, 'data' => $category];
            }

            return ['success' => false, 'errors' => $category->errors];
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
     * Will update a business category.
     *
     * @param $id <string> - business category id to be updated
     * @param $params <object> - post data to save
     *
     * @return <array>
     */
    public function updateCategory($id, array $params)
    {
        $attributes['name'] = strtolower($params['name']);
        $attributes['description'] = $params['description'] ?? null;
        $attributes['industry_type_id'] = $params['industry_type_id'];
        $attributes['master_business_category_id'] = $params['master_business_category_id'];
        $attributes['main_business_category_id'] = $params['main_business_category_id'];
        $attributes['sub_business_category_id'] = $params['sub_business_category_id'];
        $attributes['ko_stat_code'] = $params['ko_stat_code'] ?? null;
        $attributes['tax_code'] = $params['tax_code'] ?? null;
        $attributes['sic_code'] = $params['sic_code'] ?? null;

        $model = BusinessCategory::find($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $model->fill($attributes);
                $model->updated_at = auth()->user()->utcTimeNow();

                if (!$model->validate()) return ['success' => false, 'errors' => $model->errors];

                $success = $model->save();

                if ($success) {
                    \DB::commit();

                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }
                    $model = $model->select()->where(['id' => $id])
                        ->with(['industryType', 'translations'])
                        ->first()->toArray();

                    return ['success' => true, 'data' => $model];
                }

                return ['success' => false, 'errors' => $model->errors];
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return ['success' => false, 'code' => 'no_model_found'];

        /*$model = $this->get($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $model->name = $data['name'];
                $model->industry_type_id = $data['industry_type_id'];
                $model->master_business_category_id = $data['master_business_category_id'];
                $model->main_business_category_id = $data['main_business_category_id'];
                $model->sub_business_category_id = $data['sub_business_category_id'];
                $model->ko_stat_code = $data['ko_stat_code'];
                $model->tax_code = $data['tax_code'];
                $model->sic_code = $data['sic_code'];
                $model->description = $data['description'];
                $model->updated_at =__utc_time_now();

                if ($model->save()) {
                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    return $this->get($model->id)->loadMissing(['translations']);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;*/
    }

    public function showCategory($id)
    {
        $category = BusinessCategory::find($id)->loadMissing(['translations']);
        // dd($category->industry_ids);
        return $category;
    }

    public function getIndustryTypeForDropdown($searchQuery)
    {
        if ($searchQuery && $searchQuery !== '') {
            $industryTypes = IndustryType::where('name', 'LIKE', "%$searchQuery%")->get();
        } else {
            $industryTypes = IndustryType::all();
        }

        return $industryTypes;
    }

    //Fetch categories. Mostly use for business cat tree layout
    public function getCategories($params)
    {
        $categories = BusinessCategory::with(['masterParent.translations', 'mainParent.translations', 'subParent.translations', 'translations']);

        $isAll = isset($params->type) && $params->type == 'all' ? true : false;
        $andWhere = [];

        if (isset($params['master_business_category_id']) || empty($params['master_business_category_id'])) {
            if ((empty($params['master_business_category_id']) || $params['master_business_category_id'] === null) && !$isAll) {
                $categories = $categories->whereNull('master_business_category_id');
            } else {
                $andWhere['master_business_category_id'] = $params['master_business_category_id'];
            }
        }

        if (isset($params['main_business_category_id']) || empty($params['main_business_category_id'])) {
            if ((empty($params['main_business_category_id']) || $params['main_business_category_id'] === null) && !$isAll) {
                $categories = $categories->whereNull('main_business_category_id');
            } else {
                $andWhere['main_business_category_id'] = $params['main_business_category_id'];
            }
        }

        if (isset($params['sub_business_category_id']) || empty($params['sub_business_category_id'])) {
            if ((empty($params['sub_business_category_id']) || $params['sub_business_category_id'] === null) && !$isAll) {
                $categories = $categories->whereNull('sub_business_category_id');
            } else {
                $andWhere['sub_business_category_id'] = $params['sub_business_category_id'];
            }
        }

        if (count($andWhere) > 0 && !$isAll) {
            $categories = $categories->where($andWhere);
        }

        $searchString = isset($params->keyword) && $params->keyword !== null ? $params->keyword : null;

        if ($searchString) {
            $categories = $categories->where(function($query) use ($searchString) {
                $query = $query->whereHas('nameTranslation', function ($q) use ($searchString) {
                    $q->where('field_value_translator.lang_en', 'like', "%$searchString%");
                    $q->orWhere('field_value_translator.lang_ko', 'like', "%$searchString%");
                    $q->orWhere('field_value_translator.lang_jap', 'like', "%$searchString%");
                });
                $query = $query->orWhere('business_category.name', 'LIKE', "%$searchString%");
            });

        }

        $categories = $categories->orderBy('id', 'ASC')->get();

        return $categories;
    }

    public function getParentCategories()
    {
        $categories = BusinessCategory::with('children.children.children.children.children')->whereNull('parentCategoryID')->orderBy('name')->get();

        return $categories;
    }

    public function getCategoryPageData($categoryLevel)
    {
        $listHelper = new ListHelper();

        $PageData = new \StdClass();
        $PageData->categoryLevels = $listHelper->categoryLevels();
        $PageData->parentCategories = $listHelper->parentCategoryPerLevel($categoryLevel);

        return $PageData;
    }
}
