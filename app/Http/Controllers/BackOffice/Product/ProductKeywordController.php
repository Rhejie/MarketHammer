<?php

namespace App\Http\Controllers\BackOffice\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\Product;

use App\Http\Requests\BackOffice\Product\ProductKeyword\StoreProductKeywordRequest;
use App\Http\Requests\BackOffice\Product\ProductKeyword\UpdateProductKeywordRequest;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductKeywordRepository;

class ProductKeywordController extends Controller
{

    public function __construct(ProductRepository $productRepository, ProductKeywordRepository $productKeywordRepository)
    {
        $this->productRepository = $productRepository;
        $this->productKeywordRepository = $productKeywordRepository;
    }

    public function store(StoreProductKeywordRequest $request)
    {
        $product_keyword = $this->productKeywordRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($product_keyword);
    }

    public function show($id)
    {
        $product_keyword = $this->productKeywordRepository->show($id);
        $className = $this->resourceItem();

        return new $className($product_keyword);
    }

    public function update(UpdateProductKeywordRequest $request, $id)
    {
        $product_keyword = $this->productKeywordRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($product_keyword);
    }

    public function destroy($id)
    {
        $product_keyword = $this->productKeywordRepository->delete($id);
        return $product_keyword;
    }


    /**
     * Get list of material.
     * and filtering of data.
     *
     * @return <JSON>
     */
    public function getProductKeywords(Request $request)
    {
        $product_keyword = $this->productKeywordRepository->productKeywords($request);

        return ['product_keyword' => $product_keyword];
    }


    protected function resourceItem(): string
    {
        return \App\Http\Resources\Product\ProductKeywordResource::class;
    }
}
