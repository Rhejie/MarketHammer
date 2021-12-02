<?php

namespace App\Repositories\BusinessList;

use App\Model\UnitOfMeasure;
use App\Repositories\Repository;

class UnitOfMeasureRepository extends Repository
{
    public function __construct(UnitOfMeasure $model)
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
    public function unitList($params)
    {
        if ($params->search) {
            $unieMeasures = UnitOfMeasure::where(function ($query) use ($params) {
                // $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })
            ->with('translations')
            ->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $unieMeasures = UnitOfMeasure::orderBy('id', 'DESC')
            ->with('translations')
            ->paginate($params->count, ['*'], 'page', $params->page);
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
            $model->created_at = __utc_time_now();

            if ($model->save()) {
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                \DB::commit();

                return $this->get($model->id)->loadMissing('translations');
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
                $model->updated_at = __utc_time_now();

                if ($model->save()) {
                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    return $this->get($model->id)->loadMissing('translations');
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }
}
