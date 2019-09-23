<?php

namespace App\Http\Controllers\Api\Saller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Gallery;
use Illuminate\Support\Facades\Input;
class ProductController extends Controller
{
	public $URL = 'https://onlineget.com';
    public function index(Request $request ,$skip = 0)
    {
    	//$product = Product::where('shop_id',$request->user_id)->get();
    	// $order = Orders::where('shop_id',$request->shop_id)->select('product_id')->get();

    	// $product = Product::whereIn('id',$order)->select('id','sell_price','name_en','image')->get();
    	// foreach ($product as  $p) {
        //     $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        //     $porder = Orders::where('product_id',$p->id)->first();
        //     $p->date = $porder->stage_date;
        //     $p->total = $porder->qty;
        //     $p->stage = $porder->stage;
        // }
    	// return response()->json([
        //     'success' => true,
        //     'data' => $product
        // ]);
        // $all_order = Orders::where('shop_id', $request->shop_id)->groupBy('user_id')->get();
        // foreach ($all_order as $key) {
        //     # code...
        //     $key->product = Product::where('id', $key->product_id)->get();
        // }
        // $all_product = Product::whereIn('id', $all_order)->select('*')->get();
        // foreach ($all_product as $p) {
        //     $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        //     $porder = Orders::where('product_id',$p->id)->first();
        //     // $p->date = $porder->stage_date;
        //     $p->overall_qty = $porder->qty;
        //     $p->stage = $porder->stage;
        // }
        $all_order = Orders::where('shop_id', $request->shop_id)->groupBy('user_id')->get();
        if ($all_order!=null) {
            foreach ($all_order as $key) {
                # code...
                $user = User::find($key->user_id);
                $key->user_name = $user->username;
                $key->user_image = $user->image_path;
                $key->count = Orders::where('user_id', $user->id)->whereNotNull('shop_id')->count();
            }
        }
    	return response()->json([
            'success' => true,
            'data' => $all_order,
        ]);
    }
    public function pendding (Request $request, $skip = 0)
    {
    	// $order = Orders::where('shop_id',$request->shop_id)->where('stage','Pending ')->select('product_id')->get();

    	// $product = Product::whereIn('id',$order)->select('id','sell_price','name_en','image')->get();
    	// foreach ($product as  $p) {
        //     $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        //     $porder = Orders::where('product_id',$p->id)->first();
        //     $p->date = $porder->stage_date;
        //     $p->total = $porder->qty;
        //     $p->stage = $porder->stage;
        // }
    	// return response()->json([
        //     'success' => true,
        //     'data' => $product
        // ]);
        
        // $pending_order = Orders::where('shop_id', $request->shop_id)->where('stage', "Pending")->select("*")->get();

        // $all_product = Product::whereIn('id', $all_order)->select('*')->get();
        // foreach ($all_product as $p) {
        //     $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        //     $porder = Orders::where('product_id',$p->id)->first();
        //     // $p->date = $porder->stage_date;
        //     $p->overall_qty = $porder->qty;
        //     $p->stage = $porder->stage;
        // }
        $pending_order = Orders::where('shop_id', $request->shop_id)->where('stage', 'Pending')->groupBy('user_id')->get();
        if ($pending_order!=null) {
            foreach ($pending_order as $key) {
                # code...
                $user = User::find($key->user_id);
                $key->user_name = $user->username;
                $key->user_image = $user->image_path;
                $key->count = Orders::where('user_id', $user->id)->where('stage', 'Pending')->count();
            }
        }
    	return response()->json([
            'success' => true,
            'data' => $pending_order
        ]);
    }
    public function shipping(Request $request, $skip = 0)
    {
    	// $order = Orders::where('shop_id',$request->shop_id)->where('stage','Shipping')->select('product_id')->get();

    	// $product = Product::whereIn('id',$order)->select('id','sell_price','name_en','image')->get();
    	// foreach ($product as  $p) {
        //     $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        //     $porder = Orders::where('product_id',$p->id)->first();
        //     $p->date = $porder->stage_date;
        //     $p->total = $porder->qty;
        //     $p->stage = $porder->stage;
        // }
    	// return response()->json([
        //     'success' => true,
        //     'data' => $product
        // ]);
        // $shipping_order = Orders::where('shop_id', $request->shop_id)->where('stage', "Shipping")->select("*")->get();

        // $all_product = Product::whereIn('id', $all_order)->select('*')->get();
        // foreach ($all_product as $p) {
        //     $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        //     $porder = Orders::where('product_id',$p->id)->first();
        //     // $p->date = $porder->stage_date;
        //     $p->overall_qty = $porder->qty;
        //     $p->stage = $porder->stage;
        // }
        $shipping_order = Orders::where('shop_id', $request->shop_id)->where('stage', 'Shipping')->groupBy('user_id')->get();
        if ($shipping_order!=null) {
            foreach ($shipping_order as $key) {
                # code...
                $user = User::find($key->user_id);
                $key->user_name = $user->username;
                $key->user_image = $user->image_path;
                $key->count = Orders::where('user_id', $user->id)->where('stage', 'Shipping')->count();
            }
        }
    	return response()->json([
            'success' => true,
            'data' => $shipping_order
        ]);
    }
    public function delivery(Request $request, $skip = 0)
    {
    	// $order = Orders::where('shop_id',$request->shop_id)->where('stage','Delivery')->select('product_id')->get();

    	// $product = Product::whereIn('id',$order)->select('id','sell_price','name_en','image')->get();
    	// foreach ($product as  $p) {
        //     $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        //     $porder = Orders::where('product_id',$p->id)->first();
        //     $p->date = $porder->stage_date;
        //     $p->total = $porder->qty;
        //     $p->stage = $porder->stage;
        // }
    	// return response()->json([
        //     'success' => true,
        //     'data' => $product
        // ]);
        // $delivery_order = Orders::where('shop_id', $request->shop_id)->where('stage', "Delivery")->select("*")->get();

        // $all_product = Product::whereIn('id', $all_order)->select('*')->get();
        // foreach ($all_product as $p) {
        //     $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        //     $porder = Orders::where('product_id',$p->id)->first();
        //     // $p->date = $porder->stage_date;
        //     $p->overall_qty = $porder->qty;
        //     $p->stage = $porder->stage;
        // }
        $delivery_order = Orders::where('shop_id', $request->shop_id)->where('stage', 'Delivery')->groupBy('user_id')->get();
        if ($delivery_order!=null) {
            foreach ($delivery_order as $key) {
                # code...
                $user = User::find($key->user_id);
                $key->user_name = $user->username;
                $key->user_image = $user->image_path;
                $key->count = Orders::where('user_id', $user->id)->where('stage', 'Delivery')->count();
            }
        }
    	return response()->json([
            'success' => true,
            'data' => $delivery_order
        ]);
    }
    public function cancel(Request $request, $skip = 0)
    {
    	// $order = Orders::where('shop_id',$request->shop_id)->where('stage','Cancel')->select('product_id')->get();

    	// $product = Product::whereIn('id',$order)->select('id','sell_price','name_en','image')->get();
    	// foreach ($product as  $p) {
        //     $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        //     $porder = Orders::where('product_id',$p->id)->first();
        //     $p->date = $porder->stage_date;
        //     $p->total = $porder->qty;
        //     $p->stage = $porder->stage;
        // }
    	// return response()->json([
        //     'success' => true,
        //     'data' => $product
        // ]);
        // $cancel_order = Orders::where('shop_id', $request->shop_id)->where('stage', "Canceled")->select("*")->get();

        // $all_product = Product::whereIn('id', $all_order)->select('*')->get();
        // foreach ($all_product as $p) {
        //     $p->path = $p->image? $this->URL.'/uploads/product/feature/'.$p->image : $this->URL . '/uploads/default-img.jpg';
        //     $porder = Orders::where('product_id',$p->id)->first();
        //     // $p->date = $porder->stage_date;
        //     $p->overall_qty = $porder->qty;
        //     $p->stage = $porder->stage;
        // }
        $cancel_order = Orders::where('shop_id', $request->shop_id)->where('stage', 'Canceled')->groupBy('user_id')->get();
        if ($cancel_order!=null) {
            foreach ($cancel_order as $key) {
                # code...
                $user = User::find($key->user_id);
                $key->user_name = $user->username;
                $key->user_image = $user->image_path;
                $key->count = Orders::where('user_id', $user->id)->where('stage', 'Canceled')->count();
            }
        }
    	return response()->json([
            'success' => true,
            'data' => $cancel_order
        ]);
    }
    public function orderreport(Request $request)
    {
        $pending = Orders::where('shop_id',$request->shop_id)->where('stage','Pending')->count();
        $shipping = Orders::where('shop_id',$request->shop_id)->where('stage','Shipping')->count();
        $delivery = Orders::where('shop_id',$request->shop_id)->where('stage','Delivery')->count();
        $cancel = Orders::where('shop_id',$request->shop_id)->where('stage','Canceled')->count();
        return response()->json([
            'success' => true,
            'pending' => $pending,
            'shipping' => $shipping,
            'delivery' => $delivery,
            'cancel' => $cancel
        ]);
    }
    public function addProduct(Request $request)
    {
        # code...
        $input = Input::except('image');
        $input['overall_qty'] = $request->qty;
        $product = Product::create($input);

        if ($request->has('image')) {
            # code...
            $control = 0;
            foreach ($request->file('image') as $key) {
                # code...
                $fileName = Gallery::uploadFile('/product',$key,$request->tmp_file);
                $gallery = new Gallery;
                $gallery->path = url('uploads/product/').'/'.$fileName;
                $gallery->galleryable_id = $product->id;
                $gallery->galleryable_type = 'Product';
                $gallery->save();
                if ($control == 0) {
                    $product->image = url('uploads/product/').'/'.$fileName;
                    $product->save();
                }
                $control++;
            }
        }
        
        return response()->json([
            'success' => true
        ]);
    }
    public function deleteProduct(Request $request)
    {
        # code...
        $product = Product::find($request->id);
        $product->delete();
        return response()->json([
            'success' => true,
        ]);
    }
    public function productreport(Request $request)
    {
        # code...
        $instock = Product::where('user_id', $request->user_id)->count();
        $low = Product::where('user_id', $request->user_id)->whereRaw('(overall_qty / 20) > qty')->count();
        $outstock = Product::where('user_id', $request->user_id)->where('qty','=','0')->count();

        return response()->json([
            'success' => true,
            'instock' => $instock,
            'low' => $low,
            'outstock' => $outstock,
        ]);
    }
    public function onsale(Request $request, $skip = 0)
    {
        # code...
        // $instock = Product::where('user_id', $request->user_id)->where('status',1)->get();
        $instock = Product::where('user_id', $request->user_id)->get();
        return response()->json([
            'success' => true,
            'data' => $instock,
            'user_id' => $request->user_id,
        ]);
    }
    public function sold(Request $request, $skip = 0)
    {
        # code...
        $sold = Orders::where('shop_id', $request->shop_id)->where('stage','Order')->groupBy('product_id')->get();
        foreach ($sold as $key) {
            # code...
            $product = Product::find($key->product_id);
            if ($product!=null) {
                # code...
                $key->count = Orders::where('shop_id', $request->shop_id)->where('stage','Order')->groupBy('product_id')->count();
                $key->product_name = $product->name_en;
                $key->product_image = $product->image;
                // $key->product_image = $product->image? $this->URL.'/uploads/product/feature/'.$product->image : $this->URL . '/uploads/default-img.jpg';
            }
    }
        return response()->json([
            'success' => true,
            'data' => $sold,
        ]);
    }
    public function getItemAllOrder(Request $request)
    {
        # code...
        $item = Orders::where('shop_id', $request->shop_id)->where('user_id', $request->user_id)->whereNotNull('shop_id')->get();
        if ($item!=null) {
            foreach ($item as $key) {
                # code...
                $product = Product::find($key->product_id);
                $key->name = $product->name_en;
                $key->image = $product->image;
                // $key->image = $product->image? $this->URL.'/uploads/product/'.$product->image : $this->URL . '/uploads/default-img.jpg';
            }
        }
        return response()->json([
            'success' => true,
            'data' => $item,
        ]);
    }
    public function getItemPendingOrder(Request $request)
    {
        # code...
        $item = Orders::where('shop_id', $request->shop_id)->where('user_id', $request->user_id)->whereNotNull('shop_id')->where('stage', 'Pending')->get();
        if ($item!=null) {
            foreach ($item as $key) {
                # code...
                $product = Product::find($key->product_id);
                $key->name = $product->name_en;
                $key->image = $product->image;
                // $key->image = $product->image? $this->URL.'/uploads/product/'.$product->image : $this->URL . '/uploads/default-img.jpg';
            }
        }
        return response()->json([
            'success' => true,
            'data' => $item,
        ]);
    }
    public function getItemShippingOrder(Request $request)
    {
        # code...
        $item = Orders::where('shop_id', $request->shop_id)->where('user_id', $request->user_id)->whereNotNull('shop_id')->where('stage', 'Shipping')->get();
        if ($item!=null) {
            foreach ($item as $key) {
                # code...
                $product = Product::find($key->product_id);
                $key->name = $product->name_en;
                $key->image = $product->image;
                // $key->image = $product->image? $this->URL.'/uploads/product/'.$product->image : $this->URL . '/uploads/default-img.jpg';
            }
        }
        return response()->json([
            'success' => true,
            'data' => $item,
        ]);
    }
    public function getItemDeliveryOrder(Request $request)
    {
        # code...
        $item = Orders::where('shop_id', $request->shop_id)->where('user_id', $request->user_id)->whereNotNull('shop_id')->where('stage', 'Delivery')->get();
        if ($item!=null) {
            foreach ($item as $key) {
                # code...
                $product = Product::find($key->product_id);
                $key->name = $product->name_en;
                $key->image = $product->image;
                // $key->image = $product->image? $this->URL.'/uploads/product/'.$product->image : $this->URL . '/uploads/default-img.jpg';
            }
        }
        return response()->json([
            'success' => true,
            'data' => $item,
        ]);
    }
    public function getItemCanceledOrder(Request $request)
    {
        # code...
        $item = Orders::where('shop_id', $request->shop_id)->where('user_id', $request->user_id)->whereNotNull('shop_id')->where('stage', 'Canceled')->get();
        if ($item!=null) {
            foreach ($item as $key) {
                # code...
                $product = Product::find($key->product_id);
                $key->name = $product->name_en;
                $key->image = $product->image;
                // $key->image = $product->image? $this->URL.'/uploads/product/'.$product->image : $this->URL . '/uploads/default-img.jpg';
            }
        }
        return response()->json([
            'success' => true,
            'data' => $item,
        ]);
    }
    public function editProductName(Request $request)
    {
        # code...
        $product = Product::find($request->id);
        $product->pcode = $request->name;
        $product->name_en = $request->name;
        $product->save();

        return response()->json([
            'success' => true
        ]);
    }
    public function editProductQty(Request $request)
    {
        # code...
        $product = Product::find($request->id);
        $product->qty = $request->qty;
        $product->save();

        return response()->json([
            'success' => true
        ]);
    }
    public function editProductSellPrice(Request $request)
    {
        # code...
        $product = Product::find($request->id);
        $product->sell_price = $request->price;
        $product->save();

        return response()->json([
            'success' => true
        ]);
    }
    public function editProductCateogry(Request $request)
    {
        # code...
        $product = Product::find($request->id);
        $product->category_id = $request->category_id;
        $product->parent_category = $request->parent_id;
        $product->sub_id = $request->sub_id;
        $product->save();

        return response()->json([
            'success' => true
        ]);
    }
    public function editProductBrand(Request $request)
    {
        # code...
        $product = Product::find($request->id);
        $product->braind = $request->brand_id;
        $product->save();

        return response()->json([
            'success' => true
        ]);
    }
    public function editProductSupplier(Request $request)
    {
        # code...
        $product = Product::find($request->id);
        $product->supplier_id = $request->supplier_id;
        $product->save();

        return response()->json([
            'success' => true
        ]);
    }
    public function editProductUnit(Request $request)
    {
        # code...
        $product = Product::find($request->id);
        $product->unit_id = $request->unit_id;
        $product->save();

        return response()->json([
            'success' => true
        ]);
    }
    public function editProductVideo(Request $request)
    {
        # code...
        $product = Product::find($request->id);
        $product->video = $request->video;
        $product->save();

        return response()->json([
            'success' => true
        ]);
    }
    public function editProductDes(Request $request)
    {
        # code...
        $product = Product::find($request->id);
        $product->des_en = $request->des;
        $product->detail_en = $request->des;
        $product->save();

        return response()->json([
            'success' => true
        ]);
    }
    public function acceptPending(Request $request)
    {
        # code...
        $product = Orders::find($request->id);
        $product->stage = 'Shipping';
        $product->save();
        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }
    public function deniedPending(Request $request)
    {
        # code...
        $product = Orders::find($request->id);
        $product->stage = 'Canceled';
        $product->save();
        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }
    public function acceptShipping(Request $request)
    {
        # code...
        $product = Orders::find($request->id);
        $product->stage = 'Delivery';
        $product->save();
        return response()->json([
            'success' => true,
            'product' => $product
        ]);
    }
}