<?php

namespace App\Http\Controllers\API\Supplier;

use Illuminate\Http\Request;
use App\Http\Controllers\API\APIController;
use \DB;
use Dotenv\Regex\Success;
use App\Repositories\BusinessList\BusinessListRepository;
use App\Repositories\Business\BusinessFollowerRepository;
use App\Repositories\Keyword\GlobalKeywordRepository;
use App\Repositories\Category\BusinessCategoryRepository;
use App\Http\Resources\Product\ProductResource;
use \App\Http\Resources\Business\{BusinessCertificationResource, BusinessMachineResource};
use \App\Http\Resources\DefaultResource;

class SupplierController extends APIController
{
    
    public function __construct(BusinessListRepository $repo, BusinessFollowerRepository $businessFollowerRepository, GlobalKeywordRepository $globalKeywordRepository, BusinessCategoryRepository $businessCategoryRepository)
    {
        $this->repo = $repo;
        $this->businessFollowerRepository = $businessFollowerRepository;
        $this->globalKeywordRepository = $globalKeywordRepository;
        $this->businessCategoryRepository = $businessCategoryRepository;
    }

    public function getAll(Request $request)
    {
        $result = $this->repo->businessList($request, false);
        $filter = $result['filter'];
        $className = $this->supplierCollection();

        return (new $className($result['list']))->additional(['filter' => $filter]);
    }

    public function store(Request $request)
    {
        $org = $this->repo->create($request->all());

        $className = $this->resourceItem();

        return new $className($org);
    }

    public function getProducts(Request $request, $id) {

        $products = $this->repo->get($id)->businessProducts();
        if(isset($request->is_primary) && $request->is_primary){
            $products = $products->where('business_products.is_primary', 1);
        }

        $products = $products->get();


        return ProductResource::collection($products);
        
    }

    public function getCertifications($id) {

        return BusinessCertificationResource::collection($this->repo->get($id)->businessCertifications);
    }

    public function getMachines($id) {

        return BusinessMachineResource::collection($this->repo->get($id)->machines);
    }

    public function getMedia($id) {

        return \App\Http\Resources\DefaultResource::collection($this->repo->get($id)->businessMedias);
    }

    public function getAddresses($id) {

        return \App\Http\Resources\DefaultResource::collection($this->repo->get($id)->businessAddress);
    }

    public function getContacts($id) {

        return \App\Http\Resources\DefaultResource::collection($this->repo->get($id)->followers);
    }

    public function getKeywords(Request $request)
    {
        $getKeywordList = $this->globalKeywordRepository->getKeywordList($request, ['id', 'name', DB::raw("'Keyword' as key_type")]);

        $searchBusiness = $this->repo->searchBusiness($request, ['id', 'legal_name as name', DB::raw("'Supplier' as key_type")]);
        $keywords = array_merge($getKeywordList->toArray(), $searchBusiness->toArray());


        $className = $this->resourceCollection();
        return new $className($keywords);
    }

    public function getCategory(Request $request){
        $result = $this->businessCategoryRepository->getCategoryList($request);
        $className = $this->resourceCollection();
        return new $className($result);
    }

    public function follow(Request $request)
    {
        $follower = $this->businessFollowerRepository->follow($request);
        $className = $this->resourceItem();

        return new $className($follower);
    }
    
    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }

    protected function resourceCollection(): string
    {
        return \App\Http\Resources\DefaultCollection::class;
    }

    protected function supplierCollection(): string
    {
        return \App\Http\Resources\Supplier\SupplierCollection::class;
    }
}
