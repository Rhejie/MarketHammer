<?php

namespace App\Http\Controllers\BackOffice\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\APIController;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\Product;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\BackOffice\ProductRequest;

use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductCategoryRepository;
use App\Repositories\SystemData\UnitOfMeasureRepository;

class ProductController extends APIController
{

    public function __construct(ProductRepository $productRepository, ProductCategoryRepository $productCategoryRepository, UnitOfMeasureRepository $unitOfMeasureRepository)
    {
        $this->repo = $productRepository;
        $this->productRepository = $productRepository;
        $this->productCategoryRepository = $productCategoryRepository;
        $this->unitOfMeasureRepository = $unitOfMeasureRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categories = $this->productCategoryRepository->all();
        $measurements = $this->unitOfMeasureRepository->all();


        if ($request->ajax()) {
            return response()->json(['categories' => $categories, 'measurements' => $measurements]);
        }

        $pageData = ['categories' => $categories, 'measurements' => $measurements];

        return view('backoffice.product.index', [
            'pageData' => $pageData,
        ]);
    }

    public function store(ProductRequest $request)
    {
        $product = $this->productRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($product);
    }

    public function show($id)
    {
        $product = $this->productRepository->show($id);
        $className = $this->resourceItem();

        return new $className($product);
    }

    public function update(ProductRequest $request, $id)
    {
        $product = $this->productRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($product);
    }

    public function destroy($id)
    {
        $product = $this->productRepository->delete($id);
        return $product;
    }


    /**
     * Get list of material.
     * and filtering of data.
     *
     * @return <JSON>
     */
    public function getProducts(Request $request)
    {
        $product = $this->productRepository->productList($request);

        return ['product' => $product];
    }


    protected function resourceItem(): string
    {
        return \App\Http\Resources\Product\ProductResource::class;
    }

    protected function resourceCollection(): string
    {
        return \App\Http\Resources\Product\ProductCollection::class;
    }
}
