<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendors;
use App\Models\Product;
use App\User;
class VendorController extends Controller
{
	public $URL = 'https://onlineget.com';
    public function index()
    {
    	$user = User::where('role','seller')->where('status',1)->select('id')->get();

    	$vendor = Vendors::whereIn('user_id',$user)->select('id','shop_name','pic')->get();

    	foreach ($vendor as  $ven) {
    		$ven->logo = $ven->pic? $this->URL.'/uploads/vendor/'.$ven->pic : $this->URL . '/uploads/default-img.jpg';

    		$ven->product = Product::where('user_id',$ven->user_id)->select('id','name_en')->orderBy('id','desc')->limit(3)->get();

    		foreach ($ven->product as $venp) {
    			$venp->path = $venp->pic? $this->URL.'/uploads/vendor/'.$venp->pic : $this->URL . '/uploads/default-img.jpg';
    		}
    	}
    	return response()->json([
            'success' => true,
            'data' => $vendor
        ]);
    }
    public function detail(Request $request,$skip = 0)
    {
    	$vendor = Vendors::where('id',$id)->select('shop_name','pic','shop_cover')->first();

    	$vendor->logo = $vendor->pic? $this->URL.'/uploads/vendor/'.$vendor->pic : $this->URL . '/uploads/default-img.jpg';

    	$vendor->banner = $vendor->shop_cover? $this->URL.'/uploads/vendor/'.$vendor->shop_cover : $this->URL . '/uploads/default-img.jpg';

    	$vendor->product = Product::where('user_id',$vendor->user_id)->select('id','name_en','sell_price','image')->orderBy('id','desc')->skip($skip)->take(10)->get();

    	foreach ($vendor->product as $venp) {
    		$venp->path = $venp->image? $this->URL.'/uploads/vendor/'.$venp->image : $this->URL . '/uploads/default-img.jpg';
    		}
    	return response()->json([
            'success' => true,
            'data' => $vendor
        ]);
    }
}
