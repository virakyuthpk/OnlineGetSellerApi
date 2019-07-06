<?php

namespace App\Http\Controllers\Api\Saller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Product;
use App\Models\Orders;
class ProductController extends Controller
{
	public $URL = 'https://onlineget.com';
    public function index(Request $request ,$skip = 0)
    {
    	//$product = Product::where('shop_id',$request->user_id)->get();
    	$order = Orders::where('shop_id',$request->user_id)->select('product_id')->get();

    	$product = Product::whereIn('id',$order)->select('id','sell_price','name_en','image')->get();
    	foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
            $porder = Orders::where('product_id',$p->id)->first();
            $p->date = $porder->stage_date;
            $p->total = $porder->qty;
            $p->stage = $porder->stage;
        }
    	return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
    public function pending (Request $request, $skip = 0)
    {
    	$order = Orders::where('shop_id',$request->user_id)->where('stage','Pending ')->select('product_id')->get();

    	$product = Product::whereIn('id',$order)->select('id','sell_price','name_en','image')->get();
    	foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
            $porder = Orders::where('product_id',$p->id)->first();
            $p->date = $porder->stage_date;
            $p->total = $porder->qty;
            $p->stage = $porder->stage;
        }
    	return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
    public function shipping(Request $request, $skip = 0)
    {
    	$order = Orders::where('shop_id',$request->user_id)->where('stage','Shipping')->select('product_id')->get();

    	$product = Product::whereIn('id',$order)->select('id','sell_price','name_en','image')->get();
    	foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
            $porder = Orders::where('product_id',$p->id)->first();
            $p->date = $porder->stage_date;
            $p->total = $porder->qty;
            $p->stage = $porder->stage;
        }
    	return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
    public function delivery(Request $request, $skip = 0)
    {
    	$order = Orders::where('shop_id',$request->user_id)->where('stage','Delivery')->select('product_id')->get();

    	$product = Product::whereIn('id',$order)->select('id','sell_price','name_en','image')->get();
    	foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
            $porder = Orders::where('product_id',$p->id)->first();
            $p->date = $porder->stage_date;
            $p->total = $porder->qty;
            $p->stage = $porder->stage;
        }
    	return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
    public function cancel(Request $request, $skip = 0)
    {
    	$order = Orders::where('shop_id',$request->user_id)->where('stage','Cancel')->select('product_id')->get();

    	$product = Product::whereIn('id',$order)->select('id','sell_price','name_en','image')->get();
    	foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
            $porder = Orders::where('product_id',$p->id)->first();
            $p->date = $porder->stage_date;
            $p->total = $porder->qty;
            $p->stage = $porder->stage;
        }
    	return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
    public function orderreport(Request $request)
    {
        $pending = Orders::where('shop_id',$request->user_id)->where('stage','Pending')->sum('qty' );
        $shipping = Orders::where('shop_id',$request->user_id)->where('stage','Shipping')->sum('qty');
        $delivery = Orders::where('shop_id',$request->user_id)->where('stage','Delivery')->sum('qty');
        $cancel = Orders::where('shop_id',$request->user_id)->where('stage','Cancel')->sum('qty');
        return response()->json([
            'success' => true,
            'pending' => $pending,
            'shipping' => $shipping,
            'delivery' => $delivery,
            'cancel' => $cancel
        ]);
    }

}
