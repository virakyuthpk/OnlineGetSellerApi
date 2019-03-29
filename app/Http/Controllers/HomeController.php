<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Vendors;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Category;
use App\Models\Campaign;
use App\Models\Discount;
use App\Models\Product_varaint;
use App\Models\Variant;
use App\Models\UserStore;
use App\Models\Advertise;
use App\Models\Review;
use App\Models\Payment;
use App\Models\Province;
use App\Models\District;
use App\User;
class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }
    public $URL = 'https://onlineget.com';
    public function index($skip = 0){
    	/*slide*/

      	$data['slides'] = Slide::select('id','image')->where('status', '1')->get();
        foreach ($data['slides'] as  $slid) {
            $slid->image_path = $slid->image? $this->URL.'/uploads/slideshow/'.$slid->image : $this->URL . '/uploads/default-img.jpg';
        }
       /* popular*/
        $data['populars'] = Orders::join('products', 'products.id', 'orders.product_id')->groupBy('products.id','orders.product_id','products.name_en', 'products.image','products.parent_category','products.name_kh')->select('orders.product_id','products.name_en','products.name_kh','products.image','products.id','products.parent_category')
            ->take(4)
            ->get();
    	foreach ($data['populars'] as  $popular) {
    	    $category_name = Category::where('id',$popular->parent_category)->first();
    	     $popular->category_en = $category_name?$category_name->title_en:'';
    	     $popular->category_kh = $category_name?$category_name->title_kh:'';
    	     
    	     $popular->benner = $category_name->benner ? $this->URL . '/uploads/icon/' . $category_name->benner : $this->URL . '/uploads/icon/defaul.jpg';
    	     //$category_name?$category_name->benner:'';
    	     //$popular->total = Orders::where('product_id',$popular->product_id)->count();
    	     $popular->total =  Orders::where('product_id',$popular->product_id)->/*distinct()->*/count('product_id');
    		 $popular->image_path =  $popular->image ? $this->URL . '/uploads/product/feature/' . $popular->image : $this->URL . '/uploads/default-img.jpg';
        }
        /*shop*/
        $data['shops'] = Vendors::where('status',1)->select('id','user_id','shop_name','pic')->inRandomOrder()->take(4)->get();
        foreach ($data['shops'] as  $shop) {
            $shop->image_path = $shop->pic ? $this->URL . '/uploads/vendor/' . $shop->pic : $this->URL . '/uploads/default-img.jpg';
            $shop->products = Product::where('user_id',$shop->user_id)->inRandomOrder()->orderBy('id', 'desc')->take(3)->select('id','image')->get();
            foreach ($shop->products as  $product) {
                $product->image_path = $product->image ? $this->URL . '/uploads/product/feature/' . $product->image : $this->URL . '/uploads/default-img.jpg';
            }
        }
        /*collection*/
        $data['collections'] = Product::select('id','sell_price','name_en','name_kh','image')->orderBy('id','desc')->take(6)->get();
        foreach ($data['collections'] as  $collection) {
            $collection->image_path = $collection->image ? $this->URL . '/uploads/product/feature/' . $collection->image : $this->URL . '/uploads/default-img.jpg';
        }
        /*category*/
        $data['categories'] = Category::select('id','title_en','title_kh','icon')->where('parent_id','!=',0)->where('sub_id',0)->where('status',1)->orderBy('id','desc')->inRandomOrder()->take(8)->get();
        foreach ($data['categories'] as  $c) {
        	$c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';

            //$c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
        }
       /* products*/
        $data['products'] = Product::select('id','sell_price','name_en','name_kh','image')->orderBy('id','desc')->skip($skip)->take(10)->get();
        foreach ($data['products'] as  $product) {
            $product->image_path = $product->image ? $this->URL . '/uploads/product/feature/' . $product->image : $this->URL . '/uploads/default-img.jpg';
            $compaign = Campaign::where('status',1)->where('category_id',$product->category_id)->orWhere('product_id',$product->id)->first();
            $product->discount = 0;
            $product->discount_price = 0;
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
        /*json data*/
        if (!$data) {
            throw new HttpException(400, "Invalid data");
        }
        return response()->json(
            $data,
            200
        );
    }
     /*product detail*/
    public function ProductDetail($id,$user_id){
       try {
            $data['product'] = Product::where('id', $id)->select('id','user_id','pcode','name_en','name_kh','detail_en','detail_kh','des_en','des_kh','sell_price','model','image')
            ->get();
            foreach ($data['product'] as  $pro) {
                $pro->image_path = $pro->image ? $this->URL . '/uploads/product/feature/' . $pro->image : $this->URL . '/uploads/default-img.jpg';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->discount = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $discount = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($discount != null){
                       	$price = $pro->sell_price;
                    	$pro->discount = (int)$discount->percentage;
                    	$price_discount = ($price* $discount->percentage)/100;
                   		$pro->discount_price = (int)$price-$price_discount;
                    }
                }
                $favorite = UserStore::where('product_id',$pro->id)->where('user_id',$user_id)->where('status','Favorite')->first();
                $pro->favorite = $favorite?(int)$favorite->active : 0;
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    $gallery->image_path = $gallery->path ? $this->URL . '/uploads/product/small/' . $gallery->path : $this->URL . '/uploads/default-img.jpg';
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
            }
            return response()->json($data);
       } catch (Exception $e) {
           
       }
    }
    
    public function productListShop($shop_id , $skip =0){
    	try {
    		/* products*/
	        $data['products'] = Product::where('user_id',$shop_id)->select('id','sell_price','name_en','name_kh','image')->orderBy('id','desc')->skip($skip)->take(10)->get();
	        foreach ($data['products'] as  $product) {
	            $product->image_path = $product->image ? $this->URL . '/uploads/product/feature/' . $product->image : $this->URL . '/uploads/default-img.jpg';
	            $compaign = Campaign::where('status',1)->where('category_id',$product->category_id)->orWhere('product_id',$product->id)->first();
	            $product->discount = 0;
	            $product->discount_price = 0;
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
    /*add favorite*/
    public function addCart(Request $request){
        try {
             $arr = array(
                'user_id' => $request->user_id, 
                'product_id' => $request->product_id, 
                'status' => $request->status,
                'active' => "1"
                );

             $insert = new UserStore($arr);
             $insert->save();
             return response()->json($arr);
        } catch (Exception $e) {
            
        }
    }
    /*remove favorite*/
    public function removeFavorite($id,$user_id){
        try {
            UserStore::where('product_id',$id)->where('user_id',$user_id)->where('status','Favorite')->delete();
            return ['message'=>'success',];
        } catch (Exception $e) {
            
        }
    }
    /*my favorite*/
    public function getMyFavorite($user_id){
        try {
             $data['products'] = UserStore::select('*')->join('products', 'products.id', 'userStores.product_id')
            ->where('userStores.user_id', $user_id)
            ->where('userStores.status', 'Favorite')
            ->select('products.id','products.sell_price','products.name_en','products.name_kh','products.image','userStores.qty','variant_id')->orderBy('id','desc')
            ->get();
            foreach ($data['products'] as  $product) {
            $product->image_path = $product->image ? $this->URL . '/uploads/product/feature/' . $product->image : $this->URL . '/uploads/default-img.jpg';
            $compaign = Campaign::where('status',1)->where('category_id',$product->category_id)->orWhere('product_id',$product->id)->first();
            /*$product->variant = Variant::where('id', $product->variant_id)->select()->first();*/
             $variant = Variant::where('id', $product->variant_id)->select('name_en')->first();
            $product->variant = $variant?$variant->name_en:'';
            $product->discount = 0;
            $product->discount_price = $product->sell_price;
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
    public function feed($skip=0){
       try {
            $data['vendors'] = Vendors::where('status',1)->select('id','user_id','shop_name','pic','detail')->skip($skip)->take(10)->get();
            foreach ($data['vendors'] as $vendor) {
                $vendor->image_path_shop = $vendor->pic ? $this->URL . '/uploads/vendor/' . $vendor->pic : $this->URL . '/uploads/default-img.jpg';
                
               $vendor->products = Product::where('user_id',$vendor->user_id)->inRandomOrder()->orderBy('id', 'desc')->take(2)->select('id','image')->get();
               foreach ($vendor->products as  $product) {
                    $product->image_path = $product->image ? $this->URL . '/uploads/product/feature/' . $product->image : $this->URL . '/uploads/default-img.jpg';
                }
            }
            return response()->json($data);
       } catch (Exception $e) {
           
       }
    }
    public function feeddetail($id){
       try {
            $data['vendors'] = Vendors::where('status',1)->where('user_id',$id)->select('id','shop_name','pic','shop_cover','detail','user_id')->get();
            foreach ($data['vendors'] as $vendor) {
                /*shop logo*/
                $vendor->image_logo_shop = $vendor->pic ? $this->URL . '/uploads/vendor/' . $vendor->pic : $this->URL . '/uploads/default-img.jpg';
                /*shop benner*/
                 $vendor->image_benner_shop = $vendor->shop_cover ? $this->URL . '/uploads/vendor/' . $vendor->shop_cover : $this->URL . '/uploads/default-img.jpg';
               /*advertise shop*/ 
               $vendor->advertise = Advertise::where('user_id',$vendor->user_id)->where('status',1)->select('image')->orderBy('id', 'desc')->get();
                foreach ( $vendor->advertise as  $ad) {
                    $ad->image_path = $ad->image ? $this->URL . '/uploads/advertise/' . $ad->image : $this->URL . '/uploads/default-img.jpg'; 
                }
               /* shop category*/
               $cat =  Product::where('user_id',$vendor->user_id)->select('parent_category')->get();
               $vendor->categories = Category::whereIn('id',$cat)->select('id','title_en','icon')->get();
               foreach ($vendor->categories as  $cate) {
                    $cate->image_path = $cate->icon ? $this->URL . '/uploads/icon/' . $cate->icon : $this->URL . '/uploads/default-img.jpg';
                   
               }
              /*  product shop*/
               $vendor->products = Product::where('user_id',$vendor->user_id)->select('id','sell_price','name_en','name_kh','image')->get();
               foreach ($vendor->products as  $product) {
                    $product->image_path = $product->image ? $this->URL . '/uploads/product/feature/' . $product->image : $this->URL . '/uploads/default-img.jpg';
                        $compaign = Campaign::where('status',1)->where('category_id',$product->category_id)->orWhere('product_id',$product->id)->first();
                        $product->discount = 0;
                        $product->discount_price = 0;
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
            }
            return response()->json($data);
       } catch (Exception $e) {
           
       }
    }
   /* product vendor*/
    public function productshop($id,$short,$skip=0){
        try {
            $product_list = Product::where('status',1)->where('user_id',$id)->select('id','sell_price','name_en','name_kh','image');
            
            if($short ==1){
              $data['product']  = $product_list->orderBy('sell_price','desc')->skip($skip)->take(10)->get();
            }elseif($short == 2){
               $data['product']  =  $product_list->orderBy('sell_price','asc')->skip($skip)->take(10)->get();
            }else{
               $data['product']  =  $product_list->skip($skip)->take(10)->get();
            }
            
             foreach ($data['product'] as  $pro) {
                 $pro->image_path = $pro->image ? $this->URL . '/uploads/product/feature/' . $pro->image : $this->URL . '/uploads/default-img.jpg';
               $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->discount = 0;
                $pro->discount_price = 0;
                if ($compaign != null) {
                   $discount = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($discount != null){
                        $price = $pro->sell_price;
                        $pro->discount = (int)$discount->percentage;
                        $price_discount = ($price* $discount->percentage)/100;
                        $pro->discount_price = (int)$price-$price_discount;
                    }
                }
            }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    /*mycard*/
    public function getMyCart($u_id){
        try {
            $data['mycard'] = UserStore::select('*')->join('products', 'products.id', 'userStores.product_id')
            ->where('userStores.user_id', $u_id)
            ->where('userStores.status', 'Cart')
            ->select('userStores.id','userStores.product_id','products.name_en','products.name_kh','products.image','products.sell_price', 'userStores.qty','userStores.variant_id')
            ->get();
            foreach ($data['mycard'] as  $pro) {
                $pro->image_path = $pro->image ? $this->URL . '/uploads/product/feature/' . $pro->image : $this->URL . '/uploads/default-img.jpg';
                
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $variant = Variant::where('id', $pro->variant_id)->select('name_en')->first();
                $pro->variant = $variant?$variant->name_en:'';
                $pro->discount = 0;
                $pro->discount_price = $pro->sell_price;
                if ($compaign != null) {
                   $discount = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($discount != null){
                        $price = $pro->sell_price;
                        $pro->discount = (int)$discount->percentage;
                        $price_discount = ($price* $discount->percentage)/100;
                        $pro->discount_price = (int)$price-$price_discount;
                    }
                }
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    /*remove card*/
    public function removecard($id,$user_id){
        try {
            UserStore::where('id',$id)->where('user_id',$user_id)->where('status','Cart')->delete();
            return ['message'=>'success',];
        } catch (Exception $e) {
            
        }
    }
 
    /*category*/
    public function category(){
        try {
           $data['categories'] = Category::select('id','title_en','title_kh','icon','benner')->where('parent_id',0)->where('sub_id',0)->where('status',1)->orderBy('id','desc')->get();
             foreach ($data['categories'] as  $c) {
                $c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
                $c->benner =  $c->benner ? $this->URL . '/uploads/icon/' . $c->benner : $this->URL . '/uploads/default-img.jpg';
            }
            $data['maincategory'] = Category::where('status',1)->where('parent_id','!=',0)->where('sub_id',0)->select('id','title_en','title_kh','icon')->orderBy('id','desc')->limit(12)->get();
              foreach ($data['maincategory'] as  $main) {
                $main->image_path = $main->icon ? $this->URL . '/uploads/icon/' . $main->icon : $this->URL . '/uploads/default-img.jpg';
            }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }
    /*parent category*/
    public function parentCategory($id,$skip =0){
        try {
            /*$image_benner = Category::where('id',$id)->first();
            $data['image_benner'] = $image_benner->benner ? $this->URL . '/uploads/icon/' . $image_benner->benner : $this->URL . '/uploads/default-img.jpg';*/
            $data['parent_categories'] = Category::where('parent_id', $id)->where('sub_id',0)->where('status',1)->select('id','title_en','title_kh','icon')->orderBy('id','desc')->skip($skip)->take(10)->get();
            foreach ($data['parent_categories'] as  $parent_cat) {
                $parent_cat->image_path = $parent_cat->icon ? $this->URL . '/uploads/icon/' . $parent_cat->icon : $this->URL . '/uploads/default-img.jpg';
            }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    
 /*   product category*/
    public function ProductCategory($id,$short,$skip=0){
        try {
            $product_list = Product::where('parent_category', $id)->where('status',1)->orWhere('category_id',$id)->select('id','sell_price','name_en','name_kh','image');
            
            if($short ==1){
              $data['product']  = $product_list->orderBy('sell_price','desc')->skip($skip)->take(10)->get();
            }elseif($short == 2){
               $data['product']  =  $product_list->orderBy('sell_price','asc')->skip($skip)->take(10)->get();
            }else{
               $data['product']  =  $product_list->skip($skip)->take(10)->get();
            }
            
             foreach ($data['product'] as  $pro) {
                /*product detail*/
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
               $pro->discount = 0;
                $pro->discount_price = 0;
                if ($compaign != null) {
                   $discount = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($discount != null){
                        $price = $pro->sell_price;
                        $pro->discount = (int)$discount->percentage;
                        $price_discount = ($price* $discount->percentage)/100;
                        $pro->discount_price = (int)$price-$price_discount;
                    }
                }
            }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    public function popularproduct($id,$skip=0){
        try {
            $popular = Orders::select('product_id')->get();
            $data['products'] = Product::where('parent_category',$id)->whereIn('id',$popular)->select('id','sell_price','name_en','name_kh','image')->orderBy('id','desc')->skip($skip)->take(10)->get();
            
            //$data['products'] = Product::where('parent_category',$id)->select('id','sell_price','name_en','image')->orderBy('id','desc')->skip($skip)->take(10)->get();
            foreach ($data['products'] as  $product) {
                $product->image_path = $product->image ? $this->URL . '/uploads/product/feature/' . $product->image : $this->URL . '/uploads/default-img.jpg';
                $compaign = Campaign::where('status',1)->where('category_id',$product->category_id)->orWhere('product_id',$product->id)->first();
                $product->discount = 0;
                $product->discount_price = 0;
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
    public function countfavorite($user_id){
        try {
            $data['count'] = UserStore::where('status','Favorite')->where('user_id',$user_id)->count('product_id');
            return response()->json($data);
        } catch (Exception $e) {
            
        }
       
    }
    public function countorder($user_id){
        try {
            $data['count'] = Orders::where('user_id',$user_id)->count('product_id');
            return response()->json($data);
        } catch (Exception $e) {
            
        }
       
    }
    public function listMyOrder($user_id){
        try {

            $data = Product::select('*')->join('orders', 'products.id', 'orders.product_id')
                    ->where('orders.user_id', $user_id)
                    ->select('orders.product_id','products.name_en','products.name_kh','products.image','products.id')
                    ->get();
            foreach ($data as  $pro) {
                $pro->image_path = $pro->image? $this->URL . '/uploads/product/feature/' . $pro->image: $this->URL . '/uploads/default-img.jpg';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->discount = 0;
                $pro->discount_price = 0;
                if ($compaign != null) {
                   $discount = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($discount != null){
                        $price = $pro->sell_price;
                        $pro->discount = (int)$discount->percentage;
                        $price_discount = ($price* $discount->percentage)/100;
                        $pro->discount_price = (int)$price-$price_discount;
                    }
                }
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    public function postOrder(Request $request){
        try {
             $arr = array(
                'user_id' => $request->user_id,
                'qty' => $request->qty, 
                'product_id' => $request->product_id,
                'variant_id' => $request->variant_id,
                'amout' => $request->amout,
                'f_name' => $request->firstName,
                'l_name' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                );
                $order = new Orders($arr);
                $order->save();
                // $order->interest = ['admin']; 
                // $order->title = 'New Order';
                // $order->body = 'Please check. New order is created.';
                // $order->push();
                return response()->json([
                        'message_en' => 'Your order success',
                        'message_kh' => 'ការបញ្ជាទិញរបស់អ្នកជោគជ័យ',
                        'code' => 202,
                    ], 202
                );
        } catch (Exception $e) {
            
        }

    }
    public function OrderNow($id){
       try {
            $product = Product::find($id);
            $producting = Product::where('id',$id)->get();
            $payment = Payment::get();
            $province = Province::get();
            $district = District::get();
            $pvariant = Product_varaint::where('product_id',$id)->select('varaint_id')->get();
            $variant = Variant::whereIn('id',$pvariant)->get();
            //       $total_price = '';
            $total_price = '';
            foreach ($producting as $pro) {
                $pro->compaign = Campaign::where('product_id',$pro->id)->first();
                if ($pro->compaign != null) {
                   $pro->dis = Discount::where('id',$pro->compaign->discount_id)->where('status',"1")->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $total_price = $price-$price_discount;
                    }
                }
            }

            $data = array(
                'product' => $product,
                'producting' => $producting,
                'variant' => $variant,
                'district' => $district,
                'province' => $province,
                'payment' => $payment,
            );
            return response()->json($data);
       } catch (Exception $e) {
           
       }
    }
    public function changePassword(Request $request){
    	$user = User::find($request->id);
		if (!(Hash::check($request->get('current_password'), $user->password))) {
		// The passwords matches
    		return response()->json([
                'message' => 'Your current password does not matches with the password you provided. Please try again.',
                'code' => 201,
            ], 201); 
        
		}
		if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
		//Current password and new password are same
	    return response()->json([
            'message' => 'New Password cannot be same as your current password. Please choose a different password.',
            'code' => 202,
        ], 202); 
		}
		//Change Password
		$user = User::find($request->id);
		$user->password = bcrypt($request->get('new_password'));
		$user->save();
		return response()->json([
            'message' => 'Password changed successfully !',
            'code' => 203,
        ], 203); 
		return redirect()->back()->with("success","Password changed successfully !");
	}
	public function ListProductShort($id,$short ,$skip=0){
        try {
            $product_list = Product::select('id','sell_price','name_en','image');
            if($short ==1){
              $data['product']  = $product_list->where('user_id',$id)->orderBy('sell_price','desc')->skip($skip)->take(10)->get();
            }elseif($short == 2){
               $data['product']  =  $product_list->where('user_id',$id)->orderBy('sell_price','asc')->skip($skip)->take(10)->get();
            }else{
               $data['product']  =  $product_list->skip($skip)->take(10)->get();
            }
          /*  return $data;
            die();*/
             foreach ($data['product'] as  $pro) {
                $pro->image_path = $pro->image ? $this->URL . '/uploads/product/feature/' . $pro->image : $this->URL . '/uploads/default-img.jpg';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->discount_price = 0;
                if ($compaign != null) {
                   $discount = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($discount != null){
                        $price = $pro->sell_price;
                        $pro->dis = (int)$discount->percentage;
                        $price_discount = ($price* $discount->percentage)/100;
                        $pro->discount_price = (int)$price-$price_discount;
                    }
                }
                if ($pro->discount_price == 0) {
                    $pro->discount_price = (int)$pro->sell_price;
                }
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    public function sociallogin(Request $request){
        try {
            $social_id = User::where('social_id',$request->social_id)->first();
            if ($social_id != '') {
                   return response()->json( [
                    'id' =>$social_id->id,
                    'username' => $social_id->username,
                    'social_id' => $social_id->social_id,
                    'message' => 'You  have successfull login',
                    'code' => 201,
                     ], 201
                ); 
            }else{
                $arr = array(
                    'username' => $request->username, 
                    'role' => 'buyer',
                    'social_id' => $request->social_id,
                    'status' => "1", 
                    );
                $insert = new User($arr);
                $insert->save();
                return response()->json( [
                    'id' =>$insert->id,
                    'username' => $insert->username,
                    'social_id' => $insert->social_id,
                    'message' => 'You  have successfull create account',
                    'code' => 203,
                     ], 203
                ); 
        }
        } catch (Exception $e) {
            
        }
    }
    public function listorder($skip = 0){
      $data['order'] = Orders::orderBy('created_at','DESC')->skip($skip)->take(10)->select('id','product_id','qty','subtotal','phone','f_name','l_name')->get();
      foreach ($data['order'] as $ord) {
        $ord->product = Product::where('id',$ord->product_id)->select('name_en','image')->first();
        $ord->product->image_path = $ord->product->image ? $this->URL . '/uploads/product/feature/' . $ord->product->image : $this->URL . '/uploads/default-img.jpg';
      }
      return response()->json($data);
      //return view('administrator.userorder.index',$data);
    }
    public function searchorder(Request $request){
        $set_date = $request->set_date;
        $data['order'] =  Orders::whereDate('created_at', $set_date)->orderBy('created_at', 'desc')->select('id','product_id','qty','subtotal','phone','f_name','l_name')->get();
        foreach ($data['order'] as $ord) {
        $ord->product = Product::where('id',$ord->product_id)->select('name_en','image')->first();
        $ord->product->image_path = $ord->product->image ? $this->URL . '/uploads/product/feature/' . $ord->product->image : $this->URL . '/uploads/default-img.jpg';
      }
      return response()->json($data);
    }
}
