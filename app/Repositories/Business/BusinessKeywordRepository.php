<?php

namespace App\Repositories\Business;

use App\Repositories\Repository;
use App\Model\Keyword\BusinessKeyword;

class BusinessKeywordRepository extends Repository
{
	public function __construct(BusinessKeyword $model)
    {
        parent::__construct($model);
    }
}