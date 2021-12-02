<?php

namespace App\Service\Business;

use App\Model\Business\BusinessFinance;
use App\Model\BusinessAddress;
use App\Model\BusinessCategory;
use App\Model\BusinessContact;
use App\Model\Country;
use App\Model\IndustryType;
use App\Repositories\Buyer\BuyerFormListRepository;
use Carbon\Carbon;

class SupplierListService
{
    /**
     * @var BuyerFormListRepository
     */
    private $buyerFormListRepository;

    public function __construct(BuyerFormListRepository $buyerFormListRepository)
    {
        $this->buyerFormListRepository = $buyerFormListRepository;
    }

    public function getSuppliers()
    {
        $request = request();
        $search = $request->search;
        $form_submission_id = $request->form_submission_id;

        $params = [
            'search' => $search,
            'form_submission_id' => $form_submission_id
        ];
        // 1 query
        $supplierQuery = $this->buyerFormListRepository->getSupppliersData(json_decode(json_encode($params)));

        // disable the appends;
        $suppliers = $supplierQuery->each->setAppends([]);
        $businessIds = collect($suppliers)->pluck('id')->toArray();
        $industryTypeIds = collect($suppliers)->pluck('industry_type_id')->toArray();
        $businessCategoryIds = collect($suppliers)->pluck('business_category_id')->toArray();

        // 2 query get all business address based on the result of get business list
        $businessAddresses = BusinessAddress::query()
            ->select(['address_line_1', 'business_id', 'country_id', 'address_line_2', 'city'])
            ->whereIn('business_id', $businessIds)
            ->get();

        $countryIds = $businessAddresses->pluck('country_id')->toArray();

        // 3 query get countries
        $countries = Country::query()->select(['id', 'name'])->whereIn('id', $countryIds)->get();

        // 4 query get industry types
        $industryTypes = IndustryType::query()->select(['id', 'name'])->whereIn('id', $industryTypeIds)->get();

        // 5 query get business contacts
        $businessContacts = BusinessContact::query()->select(['business_id', 'is_primary', 'name'])
            ->whereIn('business_id', $businessIds)
            ->where('is_primary', 1)
            ->get();
        // 6 query get business categories;
        $businessFinances = BusinessFinance::query()
            ->select(['revenue', 'year', 'business_id'])
            ->whereIn('business_id', $businessIds)
            ->orderBy('year', 'DESC')
            ->get();

        // 7 query get business categories;
        $businessCategories = BusinessCategory::query()
            ->select(['id', 'name'])
            ->whereIn('id', $businessCategoryIds)
            ->get();
        $supplierItems = [];
        foreach ($suppliers as $supplier) {

            $address = "";
            $addressLineOne = "";
            $addressLineTwo = "";
            $city = "";
            $countryName = "";
            $industryTypeName = "";
            $date = "";
            $contact = "";
            $latestRevenue = "";
            $categoryName = "";

            $businessAddress = $businessAddresses->where('business_id', $supplier->id)->first();

            if ($businessAddress) {

                $address .= $businessAddress->address_line_1 . ', ' . $businessAddress->city;
                $addressLineOne .= $businessAddress->address_line_1;
                $addressLineTwo .= $businessAddress->address_line_2;
                $city = $businessAddress->city;

                $country = $countries->where('id', $businessAddress->country_id)->first();

                if ($country) {
                    $address .= ', ' . $country->name;
                    $countryName .= $country->name;
                }
            }

            $industryType = $industryTypes->where('id', $supplier->industry_type_id)->first();

            if ($industryType) {
                $industryTypeName = $industryType->name;
            }

            if ($supplier->created_at) {
                $date = Carbon::parse($supplier->created_at)->format('Y-m-d');
            }

            $primaryContact = $businessContacts->where('business_id', $supplier->id)
                ->where('is_primary', 1)
                ->first();

            if ($primaryContact) {
                $contact = $primaryContact->name;
            }

            $businessFinance = $businessFinances->where('business_id', $supplier->id)->first();

            if ($businessFinance) {
                $latestRevenue .= $businessFinance->revenue;
            }

            $category = $businessCategories->where('id', $supplier->business_category_id)->first();

            if ($category) {
                $categoryName = $category->name;
            }

            $supplierItems[] = [
                'id' => $supplier->id,
                'legal_name' => $supplier->legal_name,
                'address' => $address,
                'address_line_one' => $addressLineOne,
                'address_line_two' => $addressLineTwo,
                'address_city' => $city,
                'country' => $categoryName,
                'industry_type' => $industryTypeName,
                'registered_at' => $date,
                'primary_contact' => $contact,
                'latest_revenue' => $latestRevenue,
                'category' => $categoryName,
            ];
        }

        return $supplierItems;
    }
}