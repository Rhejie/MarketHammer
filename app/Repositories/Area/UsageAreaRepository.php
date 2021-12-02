<?php

namespace App\Repositories\Area;

use App\Repositories\Repository;
use App\Model\UsageArea;

class UsageAreaRepository extends Repository
{

    public function __construct(UsageArea $model)
    {
        parent::__construct($model);
    }

    public function getAreas($params)
    {
        if ($params->search) {
            $areas = $this->model()->where(function ($query) use ($params) {
                // $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->with('translations')->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $areas = $this->model()->with('translations')->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        }

        return $areas;
    }

    public function store($param)
    {
        $area = $this->model::create([
            'name' => $param->name,
            'description' => $param->description
        ]);

        if ($area) {
            if ($this->hasTranslationData()) {
                $this->storeFieldTranslations($area);
            }
        }

        return $area->loadMissing(['translations']);
    }

    public function updateArea($id, $data)
    {
        $edited = $this->model::find($id);

        $edited->update([
            'name' => $data->name,
            'description' => $data->description
        ]);

        if ($edited) {
            if ($this->hasTranslationData()) {
                $this->updateFieldTranslations($edited);
            }
        }
        
        $edited = UsageArea::find($id);

        return $edited->loadMissing(['translations']);
    }
}
