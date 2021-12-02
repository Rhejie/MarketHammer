<?php

namespace App\Http\Controllers\BackOffice\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\Product;
use App\Model\Business\BusinessProduct;

use App\Repositories\Business\BusinessProductRepository;

class BusinessProductController extends Controller
{

    public function __construct(BusinessProductRepository $businessProductRepository)
    {
        $this->businessProductRepository = $businessProductRepository;
    }

    public function store(Request $request)
    {
        $product = $this->businessProductRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($product);
    }

    public function show($id)
    {
        $product = $this->businessProductRepository->show($id);
        $className = $this->resourceItem();

        return new $className($product);
    }

    public function update(Request $request, $id)
    {
        $product = $this->businessProductRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($product);
    }

    public function destroy($id)
    {
        //dd($id);
        //$product = $this->businessProductRepository->delete($id);
        $product = BusinessProduct::where('product_id', $id)->first();
        if(!empty($product)) {
            $product->delete();
        }
        else {
            $p = Product::find($id);
            $p->delete();
        }

        return $product ? $product : $p;
    }


    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }
}
