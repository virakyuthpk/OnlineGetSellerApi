<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DiscountResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'discountId' => (int) $this->id,
            'percentage' => (int) $this->percentage,    
        ];
    }
}