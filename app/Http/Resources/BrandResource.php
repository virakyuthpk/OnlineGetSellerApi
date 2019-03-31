<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BrandResource extends Resource
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
            'productId' => (int) $this->id,
            'productNameEn' => $this->name_en,
            'productNameKh' => $this->name_kh,
            'featureImage' => asset('uploads/brand/' . $this->image), 
            'website' => $this->website
        ]; 
    }
}