<?php

namespace App\Repositories\Product;

use App\Model\ProductCategories;
use App\Repositories\Repository;

class ProductCategoriesRepository extends Repository
{
    public function __construct(ProductCategories $model)
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
    public function productCategoriesList($params)
    {
        if ($params->search) {
            $unieMeasures = ProductCategories::where(function ($query) use ($params) {
                // $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $unieMeasures = ProductCategories::paginate($params->count, ['*'], 'page', $params->page);
        }

        return $unieMeasures;
    }


    /**
     * Override parent create functionality.
     *
     * @param $data <array> - post inforation
     *
     * @return <object || boolean>
     */
    public function create(array $data)
    {
        \DB::beginTransaction();
        try {
            $model = $this->model;
            $model->name = $data['name'];
            $model->description = $data['description'];
            $model->master_product_category_id = $data['master_product_category_id'] ?? null;
            $model->main_product_category_id = $data['main_product_category_id'] ?? null;
            $model->sub_product_category_id = $data['sub_product_category_id'] ?? null;
            $model->created_at =__utc_time_now();

            if (!$model->validate()) return ['success' => false, 'errors' => $model->errors];

            $success = $model->save();

            if ($success) {
                \DB::commit();

                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                $model = ProductCategories::where('id', $model->id)
                    ->select()
                    ->with(['masterParent', 'mainParent', 'subParent', 'translations'])
                    ->first()->toArray();

                return ['success' => true, 'data' => $model];
            }

            return ['success' => false, 'errors' => $model->errors];
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }
    }

    /**
     * Override parent update functionality.
     *
     * @param $id <int>
     * @param $data <array>
     *
     * @return <object || boolean>
     */
    public function update(array $data, $id)
    {
        $model = $this->get($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $model->name = $data['name'];
                $model->description = $data['description'];
                $model->master_product_category_id = $data['master_product_category_id'] ?? null;
                $model->main_product_category_id = $data['main_product_category_id'] ?? null;
                $model->sub_product_category_id = $data['sub_product_category_id'] ?? null;
                $model->updated_at =__utc_time_now();

                if ($model->save()) {
                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    $model = ProductCategories::where('id', $model->id)
                    ->select()
                    ->with(['masterParent', 'mainParent', 'subParent', 'translations'])
                    ->first()->toArray();

                    return ['success' => true, 'data' => $model];
                }

                return ['success' => false, 'errors' => $model->errors];
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }

    public function destroyProductCategory($id)
    {
        // 2. remove industryTypeID on businesslists
        //$businessList = BusinessLists::where('industryTypeID', $id)->update(['industryTypeID' => null]);

        // 3. remove productCategory on table

        $model = ProductCategories::find($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                //Check if has children
                $getChildren = ProductCategories::where('master_product_category_id', $id)->orWhere('main_product_category_id', $id)->orWhere('sub_product_category_id', $id)->count();
                if ($getChildren > 0) {
                    return ['success' => false, 'error' => "has_children"];
                }

                $success = $model->delete();

                if ($success) {
                    \DB::commit();

                    return ['success' => true, 'data' => $id];
                }

                return ['success' => false];
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return ['success' => false, 'code' => 'no_model_found'];
    }


    public function getCategories($params)
    {
        $categories = ProductCategories::with(['masterParent', 'mainParent', 'subParent']);

        $andWhere = [];

        if (isset($params['master_product_category_id']) || empty($params['master_product_category_id'])) {
            if (empty($params['master_product_category_id']) || $params['master_product_category_id'] === null) {
                $categories = $categories->whereNull('master_product_category_id');
            } else {
                $andWhere['master_product_category_id'] = $params['master_product_category_id'];
            }
        }

        if (isset($params['main_product_category_id']) || empty($params['main_product_category_id'])) {
            if (empty($params['main_product_category_id']) || $params['main_product_category_id'] === null) {
                $categories = $categories->whereNull('main_product_category_id');
            } else {
                $andWhere['main_product_category_id'] = $params['main_product_category_id'];
            }
        }

        if (isset($params['sub_product_category_id']) || empty($params['sub_product_category_id'])) {
            if (empty($params['sub_product_category_id']) || $params['sub_product_category_id'] === null) {
                $categories = $categories->whereNull('sub_product_category_id');
            } else {
                $andWhere['sub_product_category_id'] = $params['sub_product_category_id'];
            }
        }

        if (count($andWhere) > 0) {
            $categories = $categories->where($andWhere);
        }

        $categories = $categories->with(['translations'])->orderBy('id', 'ASC')->get();

        return $categories;
    }
}
