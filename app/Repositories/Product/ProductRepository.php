<?php

namespace App\Repositories\Product;

use App\Repositories\Repository;

use App\Model\Product;

class ProductRepository extends Repository
{

    public function __construct(Product $model)
    {
        parent::__construct($model);
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
            $modelData = $data;
            if ($this->hasTranslationData()) {
                unset($modelData->translations);
            }

            $model = $this->model()->create($modelData);

            if ($model) {
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                \DB::commit();

                return $this->get($model->id);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return false;
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
                $modelData = $data;
                if ($this->hasTranslationData()) {
                    unset($modelData->translations);
                }

                if ($model->update($modelData)) {

                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    return $this->get($model->id);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }

    public function productList($params, $paginate = true)
    {

        $product = $this->model();

        $searchString = $params->input('search');
        $searchString = isset($params->keyword) && $params->keyword !== null ? $params->keyword : null;

        if ($searchString) {
            $product = $product->where(function ($query) use ($searchString) {
                $query->orWhere('name', 'LIKE', "%$searchString%");
            });
        }

        $andWhere = [];

        if (isset($params->master_category_id) && $params->master_category_id !== null) {
            $andWhere['master_category_id'] = $params->master_category_id;
        }

        if (isset($params->main_category_id) && $params->main_category_id !== null) {
            $andWhere['main_category_id'] = $params->main_category_id;
        }

        if (isset($params->sub_category_id) && $params->sub_category_id !== null) {
            $andWhere['sub_category_id'] = $params->sub_category_id;
        }

        if (count($andWhere) > 0) {
            $product = $product->where($andWhere);
        }

        if (isset($params->business_id) && $params->business_id !== null) {
            $business_id = $params['business_id'];
            $product = $product->with(['businessProduct' => function ($query) use ($business_id) {
                $query->where('business_id', $business_id);
            }]);

            $product = $product->whereHas('businessProduct', function ($q) use ($business_id) {
                $q->where('business_id', '=', $business_id);
            });
        }
        //Do not fetc product existing to params : not_in_business_id (int)
        else if (isset($params->not_in_business_id) && $params->not_in_business_id !== null) {
            $business_id = $params['not_in_business_id'];
            $product = $product->whereDoesntHave('businessProduct', function ($q) use ($business_id) {
                $q->where('business_id', '=', $business_id);
            });
        }

        $product = $product->with(['subCategory', 'unitMeasure', 'translations', 'media']);
        if ($paginate) {
            $product = $product->paginate($params->current_size, ['*'], 'page', $params->current_page);
        } else {
            if(isset($params->limit) && $params->limit){
                $product = $product->limit($params->limit);
            }
            $product = $product->get();
        }

        return $product;
    }
}
