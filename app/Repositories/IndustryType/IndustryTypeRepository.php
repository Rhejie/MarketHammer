<?php

namespace App\Repositories\IndustryType;

use App\Model\IndustryType;
use App\Repositories\Repository;

class IndustryTypeRepository extends Repository
{
    public function __construct(IndustryType $model)
    {
        parent::__construct($model);
    }

    /**
     * Retrieve list of industry types
     *
     * @param $params <object> - use to filter return data
     *
     * @return <array>
     */
    public function getIndustryTypes($params = null)
    {
        $industryTypes = [];

        if ($params) {
            if ($params->search) {
                $industryTypes = IndustryType::where(function ($query) use ($params) {
                    $query->orWhere('name', 'LIKE', "%$params->search%");
                })->orderBy('id', 'DESC')
                    ->with(['translations'])->paginate($params->count);
            } else {
                $industryTypes = IndustryType::with(['translations'])->orderBy('id', 'DESC')->paginate($params->count);
            }
        } else {
            $industryTypes = IndustryType::orderBy('id', 'DESC')->localeTranslation()->get()->toArray();
        }

        return $industryTypes;
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

                    return $this->get($model->id);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }
}
