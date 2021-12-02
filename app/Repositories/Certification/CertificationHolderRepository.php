<?php

namespace App\Repositories\Certification;

use App\Repositories\Repository;
use App\Model\CertificationHolder;

class CertificationHolderRepository extends Repository
{
    /**
     * Retrieve list of certificationHolders
     *
     * @param $params <object> - use to filter return data
     *
     * @return <array>
     */

    public function __construct(CertificationHolder $model)
    {
        parent::__construct($model);
    }

    
    public function getAll($params = null)
    {
        $data = [];

        if ($params) {
            if ($params->search) {
                $data = CertificationHolder::where(function ($query) use ($params) {
                    $query->orWhere('name', 'LIKE', "%$params->search%");
                })->with('translations')->orderBy('id', 'DESC')
                    ->paginate($params->count);
            } else {
                $data = CertificationHolder::with('translations')->orderBy('id', 'DESC')->paginate($params->count);
            }
        } else {
            $data = CertificationHolder::with('translations')->orderBy('id', 'DESC')->get();
        }

        return $data;
    }

    public function store(array $data)
    {
        
        /*$data = new CertificationHolder();

        $data->name = $params->name;
        $data->description = $params->description;
        $data->save();
        //dd($this->hasTranslationData());
        /*if ($data->save()) {
            if ($this->hasTranslationData()) {
                $this->storeFieldTranslations($data);
            }

            return $this->get($data->id);
        }*/

        //return $data;

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

    public function show($id)
    {
        $data = CertificationHolder::find($id);

        return $data;
    }

    public function update(array $data, $id)
    {
        /*$data = CertificationHolder::find($id);
        $data->name = $params->name;
        $data->description = $params->description;
        $data->save();

        return $data;*/

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

    public function destroy($id)
    {
        $data = CertificationHolder::where('id', $id)->delete();

        return $this;
    }

    /**
     * Override parent create functionality.
     *
     * @param $data <array> - post inforation
     *
     * @return <object || boolean>
     */
    /*public function create(array $data)
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
    /*public function update(array $data, $id)
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
    }*/

    
}
