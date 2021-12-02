<?php

namespace App\Repositories\Certification;

use App\Repositories\Repository;
use App\Model\Setting\CertificationType;

class CertificationTypeRepository extends Repository
{
    public function __construct(CertificationType $model)
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
    public function getCertificationTypes($params = null)
    {
        $data = [];

        if ($params) {
            if ($params->search) {
                $data = CertificationType::where(function ($query) use ($params) {
                    $query->orWhere('name', 'LIKE', "%$params->search%");
                })->with(['translations'])->orderBy('id', 'DESC')->paginate($params->count);
            } else {
                $data = CertificationType::orderBy('id', 'DESC')->paginate($params->count);
            }
        } else {
            $data = CertificationType::orderBy('id', 'DESC')->get()->toArray();
        }
        //$data = $data->with(['translations']);
        return $data;
    }

    public function create(array $data)
    {
        \DB::beginTransaction();
        try {
            $model = $this->model;
            $model->name = $data['name'];
            $model->description = $data['description'];
            $model->created_at =__utc_time_now();

            if ($model->save()) {
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                \DB::commit();

                return $this->get($model->id)->loadMissing(['translations']);
            }
        } catch (\Exception $e) {
            \DB::rollBack();
            throw $e;
        }

        return false;
    }

    public function update(array $data, $id)
    {
        $model = $this->get($id);

        if ($model) {
            \DB::beginTransaction();
            try {
                $model->name = $data['name'];
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

        return false;
    }
}
