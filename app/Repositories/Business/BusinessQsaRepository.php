<?php

namespace App\Repositories\Business;

use App\Repositories\Repository;
use App\Model\Business\BusinessQsa;

class BusinessQsaRepository extends Repository
{
    public function __construct(BusinessQsa $model)
    {
        parent::__construct($model);
    }

    public function getList($request)
    {

        $getList = $this->model();

        $searchString = $request->input('search');
        $params = null;
        if ($searchString) {
            $params = function ($query) use ($searchString) {
                $query->orWhere('name', 'LIKE', "%$searchString%");
            };
        }

        if ($params) {
            $getList = $getList->where($params);
        }

        $getList = $getList->with(['qsaDetail']);
        $getList = $getList->paginate($request->current_size, ['*'], 'page', $request->current_page);

        return $getList;
    }
}
