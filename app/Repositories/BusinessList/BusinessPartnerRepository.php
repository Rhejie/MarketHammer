<?php

namespace App\Repositories\BusinessList;

use App\Repositories\Repository;
use App\Model\BusinessPartner;

class BusinessPartnerRepository extends Repository
{
    public function __construct(BusinessPartner $model)
    {
        parent::__construct($model);
    }

    public function getBusinessPartnerList($request)
    {

        $searchString = $request->input('search');
        $params = null;
        if ($searchString) {
            $params = function ($query) use ($searchString) {
                $query->orWhere('company_name', 'LIKE', "%$searchString%");
            };
        }

        if ($params) {
            $partner = $this->where($params);
        } else {
            $partner = $this;
        }
        $partner = $partner->with(['parentBusiness']);
        $partner = $partner->where('business_id', $request->input('business_id'))->paginate($request->current_size, ['*'], 'page', $request->current_page);

        return $partner;
    }
}
