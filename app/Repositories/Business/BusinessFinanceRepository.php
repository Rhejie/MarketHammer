<?php

namespace App\Repositories\Business;

use App\Repositories\Repository;
use App\Model\Business\{BusinessFinance};

class BusinessFinanceRepository extends Repository
{
	/**
     * Instancetiate the class.
     *
     * @param $model <BusinessFinance> - the model class that this repository will be handling
     */
    public function __construct(BusinessFinance $model)
    {
        parent::__construct($model);
    }
}