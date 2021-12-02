<?php

namespace App\Repositories\SystemData;
use App\Repositories\Repository;

use App\Model\UnitOfMeasure;

class UnitOfMeasureRepository extends Repository {

    public function __construct(UnitOfMeasure $model)
    {
        parent::__construct($model);
    }
}