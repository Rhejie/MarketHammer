<?php

namespace App\Repositories\BusinessEsg;

use App\Repositories\Repository;
use App\Model\BusinessEsg;

class BusinessEsgRepository extends Repository
{
    public function __construct(BusinessEsg $model)
    {
        parent::__construct($model);
    }

    public function getEsg($id, $params)
    {
        if ($params->search) {
            $businessEsg = $this->model()->where(function ($query) use ($params) {
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })
            ->where('business_id', $id)
            ->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $businessEsg = $this->model()->where('business_id', $id)->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        }

        return $businessEsg;
    }

    public function create($params)
    {
        $businessEsg = $this->model::create([
            'business_id' => $params->business_id,
            'air_pollu_grade' => $params->air_pollu_grade,
            'water_pollu_grade' => $params->water_pollu_grade,
            'noise' => $params->noise,
            'dom_water_waste' => $params->dom_water_waste,
            'ind_water_waste' => $params->ind_water_waste,
        ]);
    
        return $businessEsg;
    }

    public function update($id, $params)
    {
        $businessEsg = $this->model::find($id);
        $businessEsg->update([
            'business_id' => $params->business_id,
            'air_pollu_grade' => $params->air_pollu_grade,
            'water_pollu_grade' => $params->water_pollu_grade,
            'noise' => $params->noise,
            'dom_water_waste' => $params->dom_water_waste,
            'ind_water_waste' => $params->ind_water_waste,
        ]);

        return $businessEsg;
    }
}
