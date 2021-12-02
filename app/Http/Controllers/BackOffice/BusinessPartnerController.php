<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Repositories\BusinessList\BusinessPartnerRepository;
use App\Repositories\BusinessList\BusinessListRepository;

class BusinessPartnerController extends Controller
{

    public function __construct(BusinessPartnerRepository $businessPartnerRepository)
    {
        $this->businessPartnerRepository = $businessPartnerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $businessList = (new BusinessListRepository)->getBusinessList(null, null);
        $pageData = ['data' => [], 'businessList' => $businessList];
        return view('backoffice.businessPartner.index', [
            'pageData' => $pageData,
        ]);
    }


    public function store(Request $request)
    {
        $businessPartner = $this->businessPartnerRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($businessPartner);
    }

    public function show($id)
    {
        $businessPartner = $this->businessPartnerRepository->show($id);
        $className = $this->resourceItem();

        return new $className($businessPartner);
    }

    public function update(Request $request, $id)
    {
        $businessPartner = $this->businessPartnerRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($businessPartner);
    }

    public function destroy($id)
    {
        $businessPartner = $this->businessPartnerRepository->delete($id);
        return $businessPartner;
    }

    
    protected function resourceItem(): string
    {
        return \App\Http\Resources\Business\BusinessPartnerResource::class;
    }


    /**
     * Get list of business partner.
     * and filtering of data.
     * 
     * @return <JSON>
     */
    public function getBusinessPartners(Request $request)
    {
        $partner = $this->businessPartnerRepository->getBusinessPartnerList($request);

        return ['partner' => $partner];
    }
}
