<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Translation\FieldValueTranslatorResource;
use App\Http\Resources\DefaultResource;

class ProductResource extends JsonResource
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
        $item['sub_category'] = new ProductCategoryResource($this->subCategory);
        $item['translations'] = new FieldValueTranslatorResource($this->translations);
        $item['unit_measure'] = new UnitMeasureResource($this->unitMeasure);
        $item['media'] = new DefaultResource($this->media);

        return $item;
    }
}
