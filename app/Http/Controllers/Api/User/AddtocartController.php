<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserStore;
use App\Models\Product;
class AddtocartController extends Controller
{
    public $URL = 'https://onlineget.com';
    
    public function store(Request $request)
    {
		$arr = array(
            'user_id' => $request->user_id, 
            'product_id' => $request->product_id, 
            'status' => 'Cart',
            'active' => "1",
            'qty' => $request->qty
        );

	    $insert = new UserStore($arr);
	    $insert->save();

	    return response()->json([
            'success' => true,
            'data' => $arr
        ]);
    }
    public function delete(Request $request)
    {
    	UserStore::where('id',$request->cart_id)->where('user_id',$request->user_id)->where('status','Cart')->delete();

        return response()->json([
            'success' => true,
            'data' => 'Deleted',
        ]);
    }
    public function index (Request $request){
        $product = UserStore::join('products', 'products.id', 'userstores.product_id')->where('userstores.user_id', $request->user_id)->select('userstores.id','products.sell_price','products.name_en','products.image','userstores.qty','userstores.product_id')->orderBy('id','desc')->get();
        
        foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        }
    	return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }
    
    /*public function store(Request $request)
    {
		$arr = array(
            'user_id' => $request->user_id, 
            'product_id' => $request->product_id, 
            'status' => $request->status,
            'active' => "1"
        );

	    $insert = new UserStore($arr);
	    $insert->save();

	    return response()->json([
            'success' => true,
            'data' => $arr
        ]);
    }
    public function delete(Request $request)
    {
    	UserStore::where('product_id',$request->product_id)->where('user_id',$request->user_id)->where('status','Cart')->delete();

        return response()->json([
            'success' => true,
            'data' => 'Deleted',
        ]);
    }
    public function index (Request $request){
    	$favorit = UserStore::where('user_id', $request->user_id)
    	->where('status','Cart')->select('product_id')->get();
    	$product = Product::whereIn('id', $favorit)->select('id','name_en','sell_price')->orderBy('id','desc')->get();

    	foreach ($product as  $p) {
            $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        }
    	return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }*/
}
