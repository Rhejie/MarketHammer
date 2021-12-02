<?php

namespace App\Repositories\Complex;

use App\Repositories\Repository;

use App\Model\ComplexType;

class ComplexTypeRepository extends Repository
{
    public function __construct(ComplexType $model)
    {
        parent::__construct($model);
    }

    public function getComplexTypes($params)
    {
        if ($params->search) {
            $complexTypes = $this->model()->where(function ($query) use ($params) {
                // $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->with('translations')->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $complexTypes = $this->model()->with('translations')->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        }

        return $complexTypes;
    }

    public function store($params)
    {

        $complex = $this->model::create([
            'name' => $params->name,
            'description' => $params->description
        ]);

        if ($complex) {
            if ($this->hasTranslationData()) {
                $this->storeFieldTranslations($complex);
            }
        }

        return $complex->loadMissing(['translations']);
    }

    public function updateComplexType($id, $params)
    {
        $editedComplex = $this->model::find($id);
        $editedComplex->update([
            'name' => $params->name,
            'description' => $params->description
        ]);

        if ($editedComplex) {
            if ($this->hasTranslationData()) {
                $this->updateFieldTranslations($editedComplex);
            }
        }

        return $editedComplex->loadMissing(['translations']);

        /*$model = $this->get($id);

        if ($model) {
            \DB::beginTransaction();
            $model->name = $params['name'];
            $model->description = $params['description'];
            $model->updated_at = __utc_time_now();
            try {
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
        return false;*/
    }
}
