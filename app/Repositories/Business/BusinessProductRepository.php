<?php

namespace App\Repositories\Business;
use App\Repositories\Repository;

use App\Model\Business\BusinessProduct;

class BusinessProductRepository extends Repository {

    public function __construct(BusinessProduct $model)
    {
        parent::__construct($model);
    }
}
