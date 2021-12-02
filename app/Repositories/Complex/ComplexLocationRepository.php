<?php

namespace App\Repositories\Complex;

use App\Repositories\Repository;
use App\Model\ComplexLocation;

class ComplexLocationRepository extends Repository
{

    public function __construct(ComplexLocation $model)
    {
        parent::__construct($model);
    }

    public function getComplexLocations($params)
    {
        if ($params->search) {
            $complexLocations = $this->model()->where(function ($query) use ($params) {
                // $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->with('translations')->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $complexLocations = $this->model()->with('translations')->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        }

        return $complexLocations;
    }

    public function storeCompleLocation($params)
    {
        $complex = $this->model()->create([
            'name' => $params->name,
            'description' => $params->description,
            'country_id' => $params->country_id
        ]);

        if ($complex) {
            if ($this->hasTranslationData()) {
                $this->storeFieldTranslations($complex);
            }
        }

        return $complex->loadMissing(['translations']);
    }

    public function updateComplexLocation($id, $params)
    {
        // $complex = $this->model()->where('id', $id)->update([
        //     'name' => $params->name,
        //     'description' => $params->description
        // ]);

        $model = $this->get($id);

        if ($model) {
            \DB::beginTransaction();
            $model->name = $params['name'];
            $model->description = $params['description'];
            $model->country_id = $params['country_id'];
            $model->updated_at = __utc_time_now();
            try {
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
        // if ($complex) {
        //     if ($this->hasTranslationData()) {
        //         $this->updateFieldTranslations($complex);
        //     }
        // }

        // $editedComplex = $this->model::find($id);

        // return $editedComplex;
    }
}
