<?php

namespace App\Repositories\BusinessType;

use App\Model\BusinessType;

class BusinessTypeRepository {

    public function getBusinessTypes($params) {
        if($params->search) {
            $businessTypes = BusinessType::where(function($query) use($params) {
                // $query->orWhere('code', 'LIKE', "%$params->search%");
                $query->orWhere('name', 'LIKE', "%$params->search%");
            })->paginate($params->count, ['*'], 'page', $params->page);
        }else{
            $businessTypes = BusinessType::paginate($params->count, ['*'], 'page', $params->page);
        }

        return $businessTypes;
    }

    public function saveBusinessType($params) {
        if (isset($params->id)) {
            $businessType = BusinessType::find($params->id);
        } else {
            $businessType = new BusinessType();
        }
        $businessType->code = $params->code;
        $businessType->name = $params->name;
        $save = $businessType->save();

        return $save;
    }

    public function destroyBusinessType($id) {

        $delete = BusinessType::find($id)->delete();

        return $delete;
    }

}