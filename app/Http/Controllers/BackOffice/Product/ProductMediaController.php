<?php

namespace App\Http\Controllers\BackOffice\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\Product;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductMediaRepository;

class ProductMediaController extends Controller
{

    public function __construct(ProductMediaRepository $productMediaRepository, ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
        $this->productMediaRepository = $productMediaRepository;
    }

    public function store(Request $request)
    {
    	$media = $this->productMediaRepository->save($request->productMedias, $request->product_id);
        $className = $this->resourceItem();

        return new $className($media);
    }

    public function destroy($id)
    {
    	$media = $this->productMediaRepository->remove($id);
        return $media;
    }

    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }
}