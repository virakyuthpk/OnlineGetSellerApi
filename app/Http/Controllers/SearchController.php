<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Campaign;
use App\Models\Discount;
class SearchController extends Controller
{
	public $URL = 'https://onlineget.com';
    public function search($search,$skip=0){
        try {
            $data['products'] = Product::where('name_en','like', '%'.$search)
            ->orWhere('detail_en','like', '%'.$search.'%')
            ->orWhere('des_en','like', '%'.$search.'%')
            ->skip($skip)->take(10)
            ->select('id','category_id','name_en','image')
            ->get();
            foreach ($data['products'] as  $product) {
                /*product detail*/
                $product->image_path = $product->image == "1" ? $this->URL . '/uploads/product/feature/' . $product->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                $compaign = Campaign::where('status',1)->where('category_id',$product->category_id)->orWhere('product_id',$product->id)->first();
                $product->dis = 0;
                $product->total_price = 0;
                if ($compaign != null) {
                   $discount = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($discount != null){
                        $price = $product->sell_price;
                    	$product->discount = (int)$discount->percentage;
                    	$price_discount = ($price* $discount->percentage)/100;
                    	$product->discount_price = (int)$price-$price_discount;
                    }
                }
            }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
}
