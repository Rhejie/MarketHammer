<?php

namespace App\Repositories\Certification;

use App\Model\Certification;
use App\Repositories\Repository;

class CertificationRepository extends Repository
{
    public function __construct(Certification $model)
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
    public function getCertifications($params = null)
    {
        $data = [];

        $with = [];

        if ($params) {
            $data = Certification::orderBy('id', 'DESC')->whereNotNull('created_at');

            if ($params->search) {
                $data = $data->where(function ($query) use ($params) {
                    $query->orWhere('name', 'LIKE', "%$params->search%");
                });
            }

            if (isset($params->filter->certification_type_id) && $params->filter->certification_type_id != NULL) {
                $data = $data->where('certification_type_id', $params->filter->certification_type_id);
            }

            if (isset($params->filter->certification_holder_id) && $params->filter->certification_holder_id != NULL) {
                $data = $data->where('certification_holder_id', $params->filter->certification_holder_id);
            }


            $data = $data->with(['certificationHolder' => function ($query){
                        $query->with(['translations']);
                    }, 'certificationType' => function ($query){
                        $query->with(['translations']);
                    }, 'translations'])
                    ->paginate($params->count);
        } else {
            $data = Certification::with(['certificationHolder' => function ($query){
                        $query->with(['translations']);
                    }, 'certificationType' => function ($query){
                        $query->with(['translations']);
                    }, 'translations'])->get()->toArray();
        }

        return $data;
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
            $model->certification_type_id = $data['certification_type_id'];
            $model->certification_holder_id = $data['certification_holder_id'];
            $model->description = $data['description'];
            $model->created_at = __utc_time_now();

            if ($model->save()) {
                if ($this->hasTranslationData()) {
                    $this->storeFieldTranslations($model);
                }

                \DB::commit();

                return $this->model()->with([
                        'certificationHolder' => function($query) {
                            $query->with(['translations']);
                        },
                        'certificationType' => function($query) {
                            $query->with(['translations']);
                        }])->find($model->id)->loadMissing(['translations']);
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
                $model->certification_type_id = $data['certification_type_id'];
                $model->certification_holder_id = $data['certification_holder_id'];
                $model->description = $data['description'];
                $model->updated_at = __utc_time_now();

                if ($model->save()) {
                    if ($this->hasTranslationData()) {
                        $this->updateFieldTranslations($model);
                    }

                    \DB::commit();

                    return $this->model()->with([
                        'certificationHolder' => function($query) {
                            $query->with(['translations']);
                        },
                        'certificationType' => function($query) {
                            $query->with(['translations']);
                        }])->find($model->id)->loadMissing(['translations']);
                }
            } catch (\Exception $e) {
                \DB::rollBack();
                throw $e;
            }
        }

        return false;
    }

    public function destroy($id)
    {
        $data = Certification::where('id', $id)->delete();

        return $this;
    }
}
