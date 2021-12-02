<?php

namespace App\Repositories\Product;
use App\Repositories\Repository;

use App\Model\ProductKeywords;

class ProductKeywordRepository extends Repository {

    public function __construct(ProductKeywords $model)
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

                if($model->update($modelData)){

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

    public function productKeywords($params){

        $productKeywork = $this->model();

    	$searchString = $params->input('search');
    	if($searchString){
            $productKeywork = $productKeywork->where(function($query) use($searchString) {
                $query->orWhere('name', 'LIKE', "%$searchString%");
            });
        }

        $andWhere = [];

        if (isset($params->product_id) && $params->product_id) {
            $productKeywork = $productKeywork->where('product_id', $params->product_id);
        }

        $productKeywork = $productKeywork->with(['translations']);
        $productKeywork = $productKeywork->paginate($params->current_size, ['*'], 'page', $params->current_page);

        return $productKeywork;
    }

    public function getKeywords($params, $search = null, $select = null){
        $keyword = [];

        $searchString = $params->key;
        if($searchString){
            $productKeywork = $this->model();

            if($select){
                $productKeywork = $productKeywork->select($select);
            }

            $productKeywork = $productKeywork->where(function($query) use($searchString) {
                $query->orWhere('name', 'LIKE', "%$searchString%");
            });

            $keyword = $productKeywork->get();
        }

        return $keyword;
    }
}