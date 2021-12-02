<?php

namespace App\Http\Controllers\BackOffice\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Events;
use App\Model\Product;

use App\Repositories\Business\BusinessMachineCustomFieldRepository;

class BusinessMachineCustomFieldController extends Controller
{

    public function __construct(BusinessMachineCustomFieldRepository $businessMachineCustomFieldRepository)
    {
        $this->businessMachineCustomFieldRepository = $businessMachineCustomFieldRepository;
    }

    public function store(Request $request)
    {
        $custom_fields = $this->businessMachineCustomFieldRepository->create($request->all());
        $className = $this->resourceItem();

        return new $className($custom_fields);
    }

    public function show($id)
    {
        $custom_fields = $this->businessMachineCustomFieldRepository->show($id);
        $className = $this->resourceItem();

        return new $className($custom_fields);
    }

    public function update(Request $request, $id)
    {
        $custom_fields = $this->businessMachineCustomFieldRepository->update($request->all(), $id);
        $className = $this->resourceItem();

        return new $className($custom_fields);
    }

    public function destroy($id)
    {
        $custom_fields = $this->businessMachineCustomFieldRepository->delete($id);
        return $custom_fields;
    }

    /**
     * Get list of material.
     * and filtering of data.
     * 
     * @return <JSON>
     */
    public function getCustomFields(Request $request)
    {
        $custom_fields = $this->businessMachineCustomFieldRepository->customFields($request);

        return ['custom_fields' => $custom_fields];
    }

    
    protected function resourceItem(): string
    {
        return \App\Http\Resources\DefaultResource::class;
    }
}
