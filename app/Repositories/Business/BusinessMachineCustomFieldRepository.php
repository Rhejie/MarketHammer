<?php

namespace App\Repositories\Business;
use App\Repositories\Repository;

use App\Model\Business\BusinessMachineCustomFields;

class BusinessMachineCustomFieldRepository extends Repository {

    public function __construct(BusinessMachineCustomFields $model)
    {
        parent::__construct($model);
    }

    public function customFields($params){

        $customFields = $this->model();

        if (isset($params->business_id) && $params->business_id) {
            $customFields = $customFields->where('business_id', $params->business_id);
        }

        $customFields = $customFields->with(['machineType', 'manufacturer', 'processType']);
        $customFields = $customFields->all();

        return $customFields;
    }
}