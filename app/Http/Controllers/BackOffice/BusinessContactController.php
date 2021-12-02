<?php

namespace App\Http\Controllers\BackOffice;

use App\Model\Events;
use Illuminate\Http\Request;
use App\Model\BusinessContact;
use App\Http\Controllers\Controller;
use App\Repositories\BusinessList\BusinessListRepository;
use App\Repositories\BusinessContact\BusinessContactRepository;
use App\Http\Requests\BackOffice\Business\BusinessContact\{StoreBusinessContact, UpdateBusinessContact};

class BusinessContactController extends Controller
{
    /**
     * The abstraction layer for the business repository module
     *
     * @var BusinessContactRepository
     */
    private $businessContactRepository;

    public function __construct(BusinessContactRepository $businessContactRepository, BusinessListRepository $businessListRepository)
    {
        $this->businessContactRepository = $businessContactRepository;
        $this->businessListRepository = $businessListRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $businessList = $this->businessListRepository->all();
        $pageData = ['data' => [], 'businessList' => $businessList];

        return view('backoffice.businessContact.index', [
            'pageData' => $pageData,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusinessContact $request)
    {
        $contact = $this->businessContactRepository->create($request->all());

        $className = $this->resourceItem();

        return new $className($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = (new BusinessContactRepository())->showContact($id);

        return response()->json(['data' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBusinessContact $request, $id)
    {
        $contact = $this->businessContactRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = $this->businessContactRepository->delete($id);

        return $contact;
    }

    /**
     * Get list of business categories.
     * and filtering of data.
     *
     * @return <JSON>
     */
    public function getBusinessContacts(Request $request)
    {
        //$searchString = $request->input('searchString');

        $page = $request->page ? $request->page : 1;
        $count = $request->count ? $request->count : 10;
        $search = $request->search && $request->search != '' && $request->search !== 'null' ? $request->search : null;

        $params = [
            'page' => $page,
            'count' => $count,
            'search' => $search
        ];
        if(isset($request->business_id) && $request->business_id != '' && $request->business_id !== 'null'){
            $params['business_id'] = $request->business_id;
        }

        $contact = $this->businessContactRepository->contactList(json_decode(json_encode($params)));

        return ['contact' => $contact];
    }

    /**
     * Download the import template for Orders
     */
    public function exportContacts(Request $request)
    {
        $collections = new \App\Exports\Business\BusinessContactExport($request->all());

        return \Excel::download($collections, 'Business Contacts.xlsx');
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\Business\BusinessContactResource::class;
    }

    protected function resourceCollection(): string
    {
        return \App\Http\Resources\Business\ProductCollection::class;
    }
}
