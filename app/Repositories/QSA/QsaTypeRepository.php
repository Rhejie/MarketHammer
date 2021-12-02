<?php

namespace App\Repositories\QSA;

use App\Repositories\Repository;
use App\Model\QSAType;

class QsaTypeRepository extends Repository
{
    public function __construct(QSAType $model)
    {
        parent::__construct($model);
    }

    public function getType($request)
    {

        $getType = $this->model();

        $searchString = $request->input('search');
        $params = null;
        if ($searchString) {
            $params = function ($query) use ($searchString) {
                $query->orWhere('name', 'LIKE', "%$searchString%");
            };
        }

        if ($params) {
            $getType = $getType->where($params)->orderBy('id', 'DESC');
        }

        $getType = $getType->with(['qsaCriteria' => function ($query){
                    $query->with(['translations']);
                }, 'translations']);
        $getType = $getType->orderBy('id', 'DESC')->paginate($request->current_size, ['*'], 'page', $request->current_page);

        return $getType;
    }

    public function create($data)
    {
        \DB::beginTransaction();
        try {
            $model = $this->model;
            $model->name = $data->name;
            $model->qsa_criteria_id = $data->qsa_criteria_id;
            $model->description = $data->description;
            $model->created_at = __utc_time_now();

            if ($model->save()) {
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                \DB::commit();

                $type = $this->model()->with(['qsaCriteria' => function ($query) {$query->with(['translations']);}])->find($model->id)->loadMissing(['translations']);
                return $type;
                // return $this->get($model->id)->loadMissing(['translations']);
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
                $model->qsa_criteria_id = $data['qsa_criteria_id'];
                $model->description = $data['description'];
                $model->updated_at = __utc_time_now();

                if ($model->save()) {
                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    $type = $this->model()->with(['qsaCriteria' => function ($query) {$query->with(['translations']);}])->find($model->id)->loadMissing(['translations']);
                    return $type;
                    // return $this->get($model->id)->loadMissing(['translations']);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }
}
