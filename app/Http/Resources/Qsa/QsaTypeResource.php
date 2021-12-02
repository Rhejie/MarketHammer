<?php

namespace App\Http\Resources\Qsa;

use Illuminate\Http\Resources\Json\JsonResource;

class QsaTypeResource extends JsonResource
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
        $item['qsa_criteria'] = new QsaCriteriaResource($this->qsaCriteria);

        return $item;
    }
}
