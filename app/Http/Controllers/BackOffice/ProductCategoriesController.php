<?php

namespace App\Http\Controllers\BackOffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\ProductCategories;
use App\Repositories\Product\ProductCategoriesRepository;
use App\Http\Requests\BackOffice\ProductRequest;

class ProductCategoriesController extends Controller
{
    public function __construct(ProductCategoriesRepository $repository)
    {
        $this->repository = $repository; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $params = [
            'master_business_category_id' => null,
            'main_business_category_id' => null,
            'sub_business_category_id' => null
        ];
        $prodCategory = $this->repository->getCategories($params);
    

        if($request->ajax()) {
            return response()->json(['productCategory' => $prodCategory]);
        }

        return view('backoffice.productCategory.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $newCategory = $this->repository->create($request->all());

        return $newCategory;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $industryType = $this->repository->show($id);

        return response()->json(['industryType' => $industryType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updateCategory = $this->repository->update($request->all(), $id);

         return $updateCategory;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteCategory = $this->repository->destroyProductCategory($id);

        return $deleteCategory;
    }

    public function getCategories(Request $request) {
        $categories = (new ProductCategoriesRepository())->getCategories($request);

        return response()->json(['categories' => $categories]);
    }
}
