<?php

namespace App\Http\Resources\Material;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Material\MaterialTypeResource;

class MaterialResource extends JsonResource
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
        $item['material_type'] = new MaterialTypeResource($this->materialType);

        return $item;
    }
}
