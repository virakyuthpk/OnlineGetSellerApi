<?php

namespace App\Http\Controllers\Api;

use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function index(Product $product, $skip = 0)
    {
        return ProductResource::collection(
            $product->statusAndOrderWithPaginate($skip)->get()
        );
    }
    public function show($id, Product $product)
    {
        return new ProductResource(
             $product->detail($id)
        );
    }
    public function store(Request $request)
    {
        // mobile data
        $product_code = $request->product_code; 
        $category_id = $request->category_id; 
        $parent_category = $request->parent_category; 
        $user_id = $request->user_id; 
        $sub_id = $request->sub_id; 
        $brand_id = $request->brand_id; 
        $supplier_id = $request->supplier_id; 
        $unit_id = $request->unit_id; 
        $name_en = $request->name_en; 
        $name_kh = $request->name_kh; 
        $detail_en = $request->detail_en; 
        $detail_kh = $request->detail_kh; 
        $des_en = $request->des_en; 
        $des_kh = $request->des_kh; 
        $sell_price = $request->sell_price; 
        $model = $request->model; 
        $special = $request->special; 
        $image = $filename = Gallery::uploadFile('/slideshow',$request->file('image'),$request->tmp_file);
        $max_order = $request->max_order; 
        $status = $request->status; 
    }
}