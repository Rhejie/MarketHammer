<?php

namespace App\Repositories\Material;

use App\Repositories\Repository;
use App\Model\Material;

class MaterialRepository extends Repository
{
    public function __construct(Material $model)
    {
        parent::__construct($model);
    }

    public function getMaterialList($request)
    {

        $material = $this->model();

        $searchString = $request->input('search');
        $params = null;
        if ($searchString) {
            $params = function ($query) use ($searchString) {
                $query->orWhere('name', 'LIKE', "%$searchString%");
                $query->orWhere('description', 'LIKE', "%$searchString%");
                $query->orWhereHas('materialType', function ($query2) use ($searchString) {
                    $query2->where('name', 'LIKE', "%$searchString%");
                });
            };
        }

        if ($params) {
            $material = $material->where($params);
        }

        $material = $material->with(['materialType' => function ($query){
                        $query->with(['translations']);
                    }, 'translations']);
        $material = $material->orderBy('id', 'DESC')->paginate($request->current_size, ['*'], 'page', $request->current_page);

        return $material;
    }

    public function create(array $data)
    {
        \DB::beginTransaction();
        try {
            $model = $this->model;
            $model->name = $data['name'];
            $model->material_type_id = $data['material_type_id'];
            $model->description = $data['description'];
            $model->created_at =__utc_time_now();

            if ($model->save()) {
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                \DB::commit();

                return $this->model()->with(['materialType' => function ($query){$query->with(['translations']);}])->find($model->id)->loadMissing(['translations']);
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
                $model->material_type_id = $data['material_type_id'];
                $model->description = $data['description'];
                $model->updated_at =__utc_time_now();

                if ($model->save()) {
                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    // return $this->get($model->id)->loadMissing(['translations']);
                    return $this->model()->with(['materialType' => function ($query){$query->with(['translations']);}])->find($model->id)->loadMissing(['translations']);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }
}
