<?php

namespace App\Http\Resources\Material;

use Illuminate\Http\Resources\Json\JsonResource;

class MaterialTypeResource extends JsonResource
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

        return $item;
    }
}
