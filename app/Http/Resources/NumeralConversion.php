<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NumeralConversion extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array =  parent::toArray($request);
        if (isset($array['created_at'])) {
            $array['created_at'] = $this->resource->created_at->format('Y-m-d H:i:s');
        }
        return $array;
    }
}
