<?php

namespace App\Http\Controllers\Api\Saller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Vendors;
class ShopController extends Controller
{
	public $URL = 'https://onlineget.com';
    public function index(Request $request)
    {
    	$shop = Vendors::where('user_id',$request->user_id)->select('id','shop_name','email','phone','address','detail')->first();

    	$shop->logo  = $shop->pic? $this->URL.'/uploads/vendor/'.$shop->pic : $this->URL . '/uploads/default-img.jpg';
    	
    	$shop->cover  = $shop->shop_cover? $this->URL.'/uploads/vendor/'.$shop->shop_cover : $this->URL . '/uploads/default-img.jpg';

    	return response()->json([
            'success' => true,
            'data' => $shop
        ]);
    }
}
