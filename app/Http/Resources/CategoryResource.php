<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CategoryResource extends Resource
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
            'cateID' => (int) $this->id, 
            'titleEn' => $this->title_en,
            'titleKh' => $this->title_kh,
            'icon' => asset('uploads/icon/' . $this->icon),
            // 'banner' => $this->benner
        ]; 
    }
}