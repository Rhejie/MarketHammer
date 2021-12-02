<?php

namespace App\Http\Controllers\BackOffice\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\Product;

use App\Repositories\Business\BusinessMachineRepository;

class BusinessMachineController extends Controller
{

    public function __construct(BusinessMachineRepository $businessMachineRepository)
    {
        $this->businessMachineRepository = $businessMachineRepository;
    }

    public function store(Request $request)
    {
        $product = $this->businessMachineRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($product);
    }

    public function show($id)
    {
        $product = $this->businessMachineRepository->show($id);
        $className = $this->resourceItem();

        return new $className($product);
    }

    public function update(Request $request, $id)
    {
        $product = $this->businessMachineRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($product);
    }

    public function destroy($id)
    {
        $product = $this->businessMachineRepository->delete($id);
        return $product;
    }

    /**
     * Get list of material.
     * and filtering of data.
     * 
     * @return <JSON>
     */
    public function getBusinessMachines(Request $request)
    {
        $business_machine = $this->businessMachineRepository->businessMachines($request);

        return ['business_machine' => $business_machine];
    }

    
    protected function resourceItem(): string
    {
        return \App\Http\Resources\Business\BusinessMachineResource::class;
    }
}
