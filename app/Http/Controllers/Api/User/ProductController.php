<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Orders;
use DB;
class ProductController extends Controller
{
	public $URL = 'https://onlineget.com';
	public function index($skip = 0)
	{
		$product = Product::where('status',1)->select('id','name_en','sell_price')->orderBy('id','desc')->skip($skip)->take(10)->get();
		foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        }
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
	}
    public function search(Request $request,$skip =0){
        $name = $request->product_name;
        if($name !=''){
            $product = Product::where('name_en', 'like', '%' . $request->product_name . '%')->select('id','name_en')->orderBy('id','desc')->skip($skip)->take(10)->get();
            foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        	}
        }else{
            $product = array();
        }
       // return ['data'=>$data];
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
    public function detail($product_id)
    {
    	$product = Product::where('id',$product_id)->select('id','parent_category','sell_price','name_en','des_en')->first();

    	$product->path = $product->image? $this->URL.'/uploads/product/feature/'.$product->image : $this->URL . '/uploads/default-img.jpg';

    	$product->gallery = Gallery::where('galleryable_id',$product->id)->select('id','path')->get();

    	foreach ($product->gallery as  $galler) {
            $galler->path = $galler->path? $this->URL.'/uploads/product/feature/'.$galler->path : $this->URL . '/uploads/default-img.jpg';
        }

    	$related = Product::where('parent_category',$product->subcategory_id)->select('id','parent_category','sell_price','name_en')->orderBy('id','desc')->get();

    	foreach ($related as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        }
        return ([
            'success' => true,
            'data' => $product,
            'related' => $related
        ]);
    }
    public function productcategory($sub_category,$skip =0)
    {
    	$product = Product::where('parent_category',$sub_category)->select('id','sell_price','name_en')->skip($skip)->take(10)->get();

    	foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        }

    	return ([
            'success' => true,
            'data' => $product
        ]);
    }
    public function popular()
    {
        $popular = Orders::groupBy('product_id')
		->selectRaw('count(product_id) as total, product_id')
		->havingRaw('total > 1 ')
		->get();

		foreach ($popular as  $value) {
			$value->product = Product::where('id',$value->product_id)->select('id','name_en','image')->first();

			$value->product->path = $value->product->image? $this->URL.'/uploads/product/feature/'.$value->product->image : $this->URL . '/uploads/default-img.jpg';
		}

    	return ([
            'success' => true,
            'data' => $popular
        ]);
    }
}
