<?php

namespace App\Http\Resources;

use App\Models\Category; 
use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $parentCate = Category::find($this->parent_category);
        $subCate = Category::find($this->sub_id);
        $category = Category::find($this->category_id);
        return [
            'productID' => (int) $this->id,
            'productCode' => $this->pcode,
            'category' => $category?$category->title_en:'N\A',
            'parentCategory' => $parentCate?$parentCate->title_en:'N\A',
            'creator' => $this->user?$this->user->username:'N\A',
            'subCategory' => $subCate?$subCate->title_en: 'N\A',
            'brand' => $this->brand?$this->brand->name_en:'N\A',
            'supplier' => $this->supplier?$this->supplier->name_en:'N\A',
            'unit' => $this->unit?$this->unit->name_en:'N\A',
            'detailEn' => $this->detail_en,
            'detailKh' => $this->detail_kh,
            'descriptionEn' => $this->des_en,
            'descriptionKh' => $this->des_kh,
            'price' => $this->sell_price,
            'model' => $this->model,
            'special' => $this->special,
            'maximunOrder' => $this->max_order,
            'productNameEn' => $this->name_en,
            'productNameKh' => $this->name_kh,
            'featureImage' => asset('uploads/product/feature/'. $this->image)
        ];
    }
}