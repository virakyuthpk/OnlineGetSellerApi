<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SupplierResource extends Resource
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
            'supplierId' => (int) $this->id,
            'supplierNameEn' => $this->name_en,
            'supplierNameKh' => $this->name_kh,
            'phoneNumber' => $this->mobile,
            'email' => $this->email,
            'address' => $this->address, 
            'description' => $this->detail,
        ];
    }
}