<?php

namespace App\Repositories\Business;

use App\Repositories\Repository;
use App\Model\Business\BusinessProcesses;

class BusinessProcessesRepository extends Repository
{
    private $processes;
    public function __construct(BusinessProcesses $model)
    {
        parent::__construct($model);
    }

    public function createProcesses($params)
    {
        $added = 'Nope';
        foreach ($params->businessProcess as $item) {
            if(!is_string($item)) {
                $bp = BusinessProcesses::where('business_id', $params->business_id)->where('processes_id', $item)->first();
                if(empty($bp)) {
                    BusinessProcesses::create([
                        'business_id' => $params->business_id,
                        'processes_id' => $item
                    ]);
                    $added = 'Added';
                    $this->processes[] = BusinessProcesses::with('processes')->orderBy('id', 'DESC')->first();
                }
            }
        }

        return $added;
    }

    public function showProcesses($id)
    {
        $processes = BusinessProcesses::with('processes')->where('business_id', $id)->get();

        return $processes;
    }
}
