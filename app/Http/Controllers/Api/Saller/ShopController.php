<?php

namespace App\Http\Controllers\Api\Saller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Vendors;
use App\Models\Gallery;
class ShopController extends Controller
{
	public $URL = 'https://onlineget.com';
    public function index(Request $request)
    {
        $shop = Vendors::find($request->id);

        if ($shop != null) {
            return response()->json([
                'success' => true,
                'data' => $shop
            ]);
        }
    }

    public function editShopname(Request $request)
    {
        # code...
        $shop = Vendors::find($request->shop_id);
        $shop->shop_name = $request->name;
        $shop->save();
        return response()->json([
            'success' => true
        ]);
    }
    public function editShopEmail(Request $request)
    {
        # code...
        $shop = Vendors::find($request->shop_id);
        $shop->email = $request->email;
        $shop->save();
        return response()->json([
            'success' => true
        ]);
    }
    public function editShopPhone(Request $request)
    {
        # code...
        $shop = Vendors::find($request->shop_id);
        $shop->phone = $request->phone;
        $shop->save();
        return response()->json([
            'success' => true
        ]);
    }
    public function editShopAddress(Request $request)
    {
        # code...
        $shop = Vendors::find($request->shop_id);
        $shop->address = $request->address;
        $shop->save();
        return response()->json([
            'success' => true
        ]);
    }
    public function editShopDetail(Request $request)
    {
        # code...
        $shop = Vendors::find($request->shop_id);
        $shop->detail = $request->detail;
        $shop->save();
        return response()->json([
            'success' => true
        ]);
    }
    public function editShopLogo(Request $request)
    {
        # code...
        $shop = Vendors::find($request->shop_id);
        if($request->has('image')){
            $filename = Gallery::uploadFile('/shop',$request->file('image'),$request->tmp_file);
            $shop->pic = url('uploads/shop/').'/'.$filename;
        }
        $shop->save();
         return ([
            'success' => true,
            'image' => $shop->pic
        ]);
    }
    public function editShopCover(Request $request)
    {
        # code...
        $shop = Vendors::find($request->shop_id);
        if($request->has('image')){
            $filename = Gallery::uploadFile('/shop',$request->file('image'),$request->tmp_file);
            $shop->shop_cover = url('uploads/shop/').'/'.$filename;
        }
        $shop->save();
         return ([
            'success' => true,
            'image' => $shop->shop_cover
        ]);
    }
}
