<?php

namespace App\Repositories\Rfq;

use App\Repositories\Repository;
use App\Model\Buyer\FormSubmissionToSupplier;
use App\Model\Buyer\FormSubmissions;

class FormSubmissionToSupplierRepository extends Repository
{
	public function __construct(FormSubmissionToSupplier $model)
    {
        parent::__construct($model);
    }

    public function getSupplierRfq($supplier_id, $params){
        $list = $this->model();
        $list = $list->with(['formSubmission.formType', 'buyer' => function ($query2){
            $query2->with(['business'=> function ($query3){
                $query3->limit(1);
            }]);
        }])
            ->has('formSubmission')->where(['supplier_id' => $supplier_id]);

        $current_page = 1;
        if (isset($params->current_page)) {
            $current_page = $params->current_page;
        }

        if (isset($params->current_size) && $params->current_size > 0) {
            $list = $list->orderBy('id', "DESC")->paginate($params->current_size, ['*'], 'page', $current_page);
        } else {
            $list = $list->orderBy('id', "DESC")->get()->toArray();
        }


        return $list;
    }
}
