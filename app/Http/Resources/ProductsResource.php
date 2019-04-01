<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProductsResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'productID' => (int) $this->id,
            'productNameEn' => $this->name_en,
            'featureImage' => asset('uploads/product/feature/'. $this->image)
        ];
    }
}