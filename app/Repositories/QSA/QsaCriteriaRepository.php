<?php

namespace App\Repositories\QSA;

use App\Repositories\Repository;
use App\Model\QSACriteria;

class QsaCriteriaRepository extends Repository
{
    public function __construct(QSACriteria $model)
    {
        parent::__construct($model);
    }

    public function getCriteria($request)
    {

        $qsaCriteria = $this->model();

        $searchString = $request->input('search');
        $params = null;
        if ($searchString) {
            $params = function ($query) use ($searchString) {
                $query->orWhere('name', 'LIKE', "%$searchString%");
            };
        }

        if ($params) {
            $qsaCriteria = $qsaCriteria->where($params);
        }

        $qsaCriteria = $qsaCriteria->with(['translations']);
        $qsaCriteria = $qsaCriteria->orderBy('id', 'DESC')->paginate($request->current_size, ['*'], 'page', $request->current_page);

        return $qsaCriteria;
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
