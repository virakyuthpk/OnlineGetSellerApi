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
	public function index()
	{
		$product = Product::where('status',1)->select('id','name_en','sell_price','image')->orderBy('id','desc')->paginate(10);
		foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        }
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
	}
    public function search(Request $request){
        $name = $request->product_name;
        if($name !=''){
            $product = Product::where('name_en', 'like', '%' . $request->product_name . '%')->select('id','name_en','image')->orderBy('id','desc')->paginate(10);
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
    	$product = Product::where('id',$product_id)->select('id','parent_category','sell_price','name_en','des_en','image')->first();

    	$product->path = $product->image? $this->URL.'/uploads/product/feature/'.$product->image : $this->URL . '/uploads/default-img.jpg';

    	$product->gallery = Gallery::where('galleryable_id',$product->id)->select('id','path')->get();

    	foreach ($product->gallery as  $galler) {
            $galler->path = $galler->path? $this->URL.'/uploads/product/small/'.$galler->path : $this->URL . '/uploads/default-img.jpg';
        }

    	$related = Product::where('parent_category',$product->parent_category)->select('id','parent_category','sell_price','name_en','image')->orderBy('id','desc')->limit(10)->get();

    	foreach ($related as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        }
        return ([
            'success' => true,
            'data' => $product,
            'related' => $related
        ]);
    }
    public function productcategory($sub_category)
    {
    	$product = Product::where('parent_category',$sub_category)->select('id','sell_price','name_en','image')->paginate(10);

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
        $collection = Orders::groupBy('product_id')
		->selectRaw('count(product_id) as total, product_id')
		->havingRaw('total > 1 ')
		->get();

		foreach ($collection as  $value) {
			$value->product = Product::where('id',$value->product_id)->select('id','name_en','image')->first();

			$value->product->path = $value->product->image? $this->URL.'/uploads/product/feature/'.$value->product->image : $this->URL . '/uploads/default-img.jpg';
		}

    	return ([
            'success' => true,
            'data' => $collection
        ]);
    }
    public function postorder(Request $request)
    {
        $product = json_decode($request->product_id);
        //return $product;
        $lastid = Order::all();
        $lastId = collect($lastid)->last()->ordercode;
        $export = explode('N-',$lastId);
        $number = $export[1];
        $number++;
        $numbers = str_pad($number, 5, "0", STR_PAD_LEFT);  //00002
        $ordercode = "N-".$numbers;
        
        $order = new Order;
        $order->user_id = $request->user_id;
        $order->amount = $request->amount;
        $order->name = $request->name;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->ordercode = $ordercode;
        $order->save();
        $orderid = $order->id;
        foreach($product as $pro){
            $porder = new Productorder;
            $porder->product_id = $pro->pro_id;
            $porder->qty = $pro->qty;
            $porder->order_id = $orderid;
            $porder->sell_price = $request->price;
            $porder->save();
            //dd($pro->pro_id);
        }
        UserStore::where('user_id',$request->user_id)->delete();
        return ([
            'success' => true,
            'data' => 'Your order success'
        ]);
    }
    public function myorder(Request $request)
    {
        $order = Order::where('user_id',$request->user_id)->select('id','name','phone','address','ordercode','amount','created_at')->get();
        
        return response()->json([
            'success' => true,
            'data' => $order
        ]);
    }
    public function orderdetail(Request $request)
    {
        $order = Order::where('user_id',$request->user_id)->where('id',$request->order_id)->select('id')->first();
        
        $product = DB::table('product_orders')->join('products', 'products.id', '=', 'product_orders.product_id')->whereIn('product_orders.order_id',$order)->select('products.id','products.name_en','products.image','products.sell_price','product_orders.qty')->get();
        
        foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
            $p->shope_name = Vendorsa::where('user_id',$p->user_id)->first()->shop_name;
        }
        
        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
}
