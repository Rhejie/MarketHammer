<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Translation\FieldValueTranslatorResource;

class ProductKeywordResource extends JsonResource
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
        $item['translations'] = new FieldValueTranslatorResource($this->translations);

        return $item;
    }
}
