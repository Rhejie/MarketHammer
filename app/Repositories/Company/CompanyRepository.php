<?php

namespace App\Repositories\Company;

use App\Repositories\Repository;

use App\Model\Company;

class CompanyRepository extends Repository
{

    public function __construct(Company $model)
    {
        parent::__construct($model);
    }
}
