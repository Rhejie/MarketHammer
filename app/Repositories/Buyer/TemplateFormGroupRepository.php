<?php

namespace App\Repositories\Buyer;

use App\Repositories\Repository;
use App\Model\FormTemplate\{TemplateFormField, TemplateFormGroup};

class TemplateFormGroupRepository extends Repository
{
	public function __construct(TemplateFormGroup $model)
    {
        parent::__construct($model);
    }
}