<?php

namespace App\Http\Resources\Qsa;

use Illuminate\Http\Resources\Json\JsonResource;

class QsaCriteriaResource extends JsonResource
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
