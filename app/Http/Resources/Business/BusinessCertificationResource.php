<?php

namespace App\Http\Resources\Business;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Translation\FieldValueTranslatorResource;
use App\Http\Resources\DefaultResource;

class BusinessCertificationResource extends JsonResource
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
        $item['medias'] = new DefaultResource($this->medias);

        return $item;
    }
}
