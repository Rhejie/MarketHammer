<?php


namespace App\Repositories\Business;

use App\Model\Business\BusinessMaterial;
use App\Repositories\Repository;

class BusinessMaterialRepository extends Repository
{
    public function __construct(BusinessMaterial $model)
    {
        parent::__construct($model);
    }

    public function getBusinessMaterial($id, $params)
    {
        // if ($params->search) {
        //     $business_material = $this->model()->where(function ($query) use ($params) {
        //         // $query->orWhere('code', 'LIKE', "%$params->search%");
        //         $query->orWhere('name', 'LIKE', "%$params->search%");
        //     })->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        // } else {
        //     $complexTypes = $this->model()->orderBy('id', 'DESC')->paginate($params->count, ['*'], 'page', $params->page);
        // }

        $business_material = $this->model()->with('material')->orderBy('id', 'DESC')->where('business_id', $id)->paginate($params->count, ['*'], 'page', $params->page);

        return $business_material;
    }

    public function store($params)
    {
        $business_material = BusinessMaterial::create([
            'business_id' => $params->business_id,
            'material_id' => $params->material_id,
        ]);

        $respones = BusinessMaterial::with('material')->latest()->first();

        return $respones;
    }

    public function update($id, $params)
    {

        $business_material = $this->model()->where('id', $id)->update([
            'material_id' => $params->material_id
        ]);

        $respones = $this->model::with('material')->find($id);

        return $respones;
    }
}
