<?php

namespace App\Http\Resources\Business;

use Illuminate\Http\Resources\Json\JsonResource;

class BusinessContactResource extends JsonResource
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
        $item['parent_business'] = new BusinessResource($this->parentBusiness);

        return $item;
    }
}
