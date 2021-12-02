<?php

namespace App\Repositories\BusinessContact;

use App\Model\BusinessContact;
use App\Repositories\Repository;

class BusinessContactRepository extends Repository
{
    /**
     * Instancetiate the class.
     *
     * @param $model <BusinessContact> - the model class that this repository will be handling
     */
    public function __construct(BusinessContact $model)
    {
        parent::__construct($model);
    }

    /**
     * Will fetch list of business category, this function will also paginate
     * the return data if $params is present
     *
     * @param $params <null | object> - filter return data
     *
     * @return <array>
     */
    public function contactList($params)
    {
        $contacts = $this->model();

        \DB::enableQueryLog();

        if (isset($params->business_id) && $params->business_id) {
            $contacts = $contacts->where('business_id', $params->business_id);
        }

        if ($params->search) {
            $contacts = $contacts->with(['parentBusiness'])
                ->where(function ($query) use ($params) {
                    $query->orWhere('name', 'LIKE', "%$params->search%");
                })->paginate($params->count, ['*'], 'page', $params->page);
        } else {
            $contacts = $contacts->with(['parentBusiness'])->paginate($params->count, ['*'], 'page', $params->page);
        }

        return $contacts;
    }

    public function getContact($id, $with = null)
    {
        if (!$with) {
            $with = ['parentBusiness'];
        }

        $businessData = BusinessContact::where('id', $id)
            ->with($with)->first()->toArray();

        return $businessData;
    }

    public function showContact($id)
    {
        $contact = BusinessContact::find($id)->with(['parentBusiness']);

        return $contact;
    }
}
