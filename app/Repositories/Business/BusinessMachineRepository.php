<?php

namespace App\Repositories\Business;
use App\Repositories\Repository;

use App\Model\Business\BusinessMachine;

class BusinessMachineRepository extends Repository {

    public function __construct(BusinessMachine $model)
    {
        parent::__construct($model);
    }

    public function businessMachines($params){

        $businessMachine = $this->model();

    	$searchString = $params->input('search');
    	if($searchString){
            $businessMachine = $businessMachine->where(function($query) use($searchString) {
                $query->orWhere('name', 'LIKE', "%$searchString%");
            });
        }

        $andWhere = [];

        if (isset($params->business_id) && $params->business_id) {
            $businessMachine = $businessMachine->where('business_id', $params->business_id);
        }

        $businessMachine = $businessMachine->with(['machineType', 'manufacturer', 'processType', 'customFields']);
        $businessMachine = $businessMachine->paginate($params->current_size, ['*'], 'page', $params->current_page);

        return $businessMachine;
    }
}