<?php

namespace App\Repositories\Buyer;

use App\Repositories\Repository;
use App\Model\Buyer\FormSubmissions;

class FormSubmissionRepository extends Repository
{
	public function __construct(FormSubmissions $model)
    {
        parent::__construct($model);
    }

    public function clearSubmissionForm($id)
    {
    	$this->model;
    }
}