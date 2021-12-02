<?php

namespace App\Http\Resources\Business;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\SystemData\MachineTypeResource;
use App\Http\Resources\SystemData\MachineMaufacturerResource;
use App\Http\Resources\SystemData\MachineProcessTypeResource;

class BusinessMachineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        $item = parent::toArray($request);
        $item['machine_type'] = new MachineTypeResource($this->machineType);
        $item['manufacturer'] = new MachineMaufacturerResource($this->manufacturer);
        $item['process_type'] = new MachineProcessTypeResource($this->processType);
        $item['custom_fields'] = new BusinessMachineCustomFieldResource($this->customFields);

        return $item;
    }
}
