<?php

namespace App\Repositories\Material;

use App\Repositories\Repository;
use App\Model\MaterialType;

class MaterialTypeRepository extends Repository
{
    public function __construct(MaterialType $model)
    {
        parent::__construct($model);
    }

    public function getMaterialTypeList($request)
    {

        $materialType = $this->model();

        $searchString = $request->input('search');
        $params = null;
        if ($searchString) {
            $params = function ($query) use ($searchString) {
                $query->orWhere('name', 'LIKE', "%$searchString%");
            };
        }

        if ($params) {
            $materialType = $materialType->where($params);
        }

        $materialType = $materialType->with(['translations']);
        $materialType = $materialType->orderBy('id', 'DESC')->paginate($request->current_size, ['*'], 'page', $request->current_page);

        return $materialType;
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
            $model->created_at = __utc_time_now();

            if ($model->save()) {
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
                $model->name = $data['name'];
                $model->description = $data['description'];
                $model->updated_at = __utc_time_now();

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

        return false;
    }
}
