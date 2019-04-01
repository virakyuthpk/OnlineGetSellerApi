<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class VariantResource extends Resource
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
            'variantID' => (int) $this->id,
            'nameEn' => $this->name_en,
            'nameKh' => $this->name_kh
        ];
    }
}