<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as Authuser;
use Illuminate\Support\Facades\Validator;
use Socialite;
use App\Models\Brand; 
use App\Models\Unit;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Discount;
use App\Models\Category;
use App\Models\District;
use App\Models\Commune;
use App\Models\Supplier;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Product_varaint;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Cart;
use App\Models\Orders;
use App\Models\UserStore;
use App\User;
use DB;
use App\Models\Payment;
use App\Models\Province;
use App\Models\Vendors;
use App\Models\UserHelp;
use App\Models\Slide;
use App\Models\Advertise;
use App\Models\Review; 
class LoginApiController extends Controller
{
    // review and rating 
    public function reviewProduct(Request $request)
    {
        $user_id = $request->user_id; 
        $product_id = $request->product_id; 
        $rating = $request->rating; 
        $cmt = $request->cmt; 
        $review = new Review; 
        $review->user_id = $user_id; 
        $review->product_id = $product_id; 
        $review->rating = $rating; 
        $review->comment = $cmt; 
        $review->save();
        return [
            'message' => 'success',
        ];
        
    }
    public function listreview($id)
    {
        $data['review'] = Review::where('product_id', $id)->get();
        foreach($data['review'] as $review)
        {
            $user = User::where('id', $review->user_id)->first();
            $review->username = $user->username; 
            $review->image_path = $user->image_path; 
            
        }
        if ($data != null)
            return $data; 
    }
    public function countreview($id)
    {
        $count = Review::where('product_id', $id)->get();
        if(!$count->isEmpty())
        {
            $rating = Review::where('product_id', $id)->sum('rating');
            $data['count_rating'] = count($count);  
            $data['rating'] = $rating/count($count);
            $cmt = Review::where('product_id', $id)->where('comment','!=',null)->get();
            if($cmt != null)
                $data['cmt'] = count($cmt); 
            return $data;
        }
        return [
                'count_rating' => 0,
                'rating' => 0,
                'comment' => 0,
            ];
    }
    public $URL = 'https://onlineget.com';
    public function slide(){
        try {
            $data['slide'] = Slide::select('id','title','image')->where('status', '1')->get();
            foreach ($data['slide'] as  $slid) {
                $slid->image_path = $slid->image? $this->URL.'/uploads/slideshow/'.$slid->image : $this->URL . '/uploads/default-img.jpg';
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    public function advertise(){
        try {
            $data['advertise'] = Advertise::select('id','image')->where('position','app')->where('status', '1')->take(1)->get();
            foreach ($data['advertise'] as  $add) {
                $add->image_path = $add->image? $this->URL.'/uploads/advertise/'.$add->image : $this->URL . '/uploads/default-img.jpg';
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
           return json_encode([
          'data'=> [
            'id' => (int) $user->id,
            'username' => $user->name, 
            'email' => $user->email,
            'token' => (string) $user->token, 
            'avatar' => $user->avatar
          ],
        ]);  
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        return json_encode([
          'data'=> [
            'id' => (int) $user->id,
            'username' => $user->name, 
            'email' => $user->email,
            'token' => (string) $user->token, 
            'avatar' => $user->avatar
          ],
        ]);  
    }
  /*  public function userhelp(){
        try {
            $data['helps'] = UserHelp::where('status',1)->select('id','title','des')->get();
            foreach ($data['helps'] as  $help) {
                $help->des = UserHelp::where('id',$help->id)->first()->des;
                if ($help->image == "1") {
                    $help->img = $help->image == "1" ? $this->URL . '/uploads/helps/' . $help->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($help->image == "0"){
                    $help->img = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $help->img = $this->URL . '/uploads/helps/' . $help->image;
                }
            }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }*/
    public function listVendor(){
        try {
            $data = Vendors::where('status', '1')->get();

            foreach ($data as  $v) {
                $v->pic = $v->pic == 1 ? $this->URL.'/uploads/vendor/'.$v->id.'.jpg' : $this->URL . '/uploads/default-img.jpg';
                $v->countPro = Product::where('user_id', $v->user_id)->where('status', 1)->count();
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    public function listAllProduct($skip=0){
        try {
            $data['product'] = Product::skip($skip)->take(10)->get();
             foreach ($data['product'] as  $pro) {
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $b = Brand::where('id',$pro->braind_id)->first();
                $pro->brandName = $b ? $b->name_en : '';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                        //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
                $vender = Vendors::where('user_id',$pro->user_id)->first();
                $data['vendor'] = $vender?$vender->shop_name:'Onlineget';
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    public function listProduct($id){
       try {
            $data['product'] = Product::where('category_id', $id)
            ->orWhere('parent_category', $id)->get();
            foreach ($data['product'] as  $pro) {
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $b = Brand::where('id',$pro->braind_id)->first();
                $pro->brandName = $b ? $b->name_en : '';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                        //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
                $data['vender'] = Vendors::where('user_id',$pro->user_id)->first();
             }
            return response()->json($data);
       } catch (Exception $e) {
           
       }
    }
    public function listAdvanceSearch($search,$skip=0){
        try {
            $data['product'] = Product::where('name_en','like', '%'.$search.'%')
            ->orWhere('detail_en','like', '%'.$search.'%')
            ->orWhere('des_en','like', '%'.$search.'%')
            ->skip($skip)->take(6)
            ->get();
            foreach ($data['product'] as  $pro) {
              /*  $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
                $pro->unit = Unit::where('id',$pro->unit_id)->first();
                $pro->category = Category::where('id',$pro->category_id)->first();
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }*/
                /*product detail*/
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $b = Brand::where('id',$pro->braind_id)->first();
                $pro->brandName = $b ? $b->name_en : '';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                        //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
     public function getMyCart($u_id)
    {
        try {
            $data = UserStore::select('*')->join('products', 'products.id', 'userStores.product_id')
            ->where('userStores.user_id', $u_id)
            ->where('userStores.status', 'Cart')
            ->get();

            foreach ($data as  $pro) {
              /*  $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
                $pro->unit = Unit::where('id',$pro->unit_id)->first();
                $pro->category = Category::where('id',$pro->category_id)->first();
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }*/
                /*product detail*/
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $b = Brand::where('id',$pro->braind_id)->first();
                $pro->brandName = $b ? $b->name_en : '';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                        //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
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
     public function getMyFavorite($u_id)
    {
        try {
             $data = UserStore::select('*')->join('products', 'products.id', 'userStores.product_id')
            ->where('userStores.user_id', $u_id)
            ->where('userStores.status', 'Favorite')
            ->get();

            foreach ($data as  $pro) {
              /*  $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
                $pro->unit = Unit::where('id',$pro->unit_id)->first();
                $pro->category = Category::where('id',$pro->category_id)->first();
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }*/
                /*product detail*/
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $b = Brand::where('id',$pro->braind_id)->first();
                $pro->brandName = $b ? $b->name_en : '';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                        //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    /*public function feed(){
       try {
            $data['product'] = Product::orderBy('created_at', 'desc')
            ->take(6)
            ->get();
            foreach ($data['product'] as  $pro) {
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $b = Brand::where('id',$pro->braind_id)->first();
                $pro->brandName = $b ? $b->name_en : '';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                        //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
       } catch (Exception $e) {
           
       }
    }*/
     public function collection(){
    	try {
           $data['product'] = Product::get();
           foreach ($data['product'] as  $pro) {
              /*  $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
                $pro->unit = Unit::where('id',$pro->unit_id)->first();
                $pro->category = Category::where('id',$pro->category_id)->first();
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }*/
                /*product detail*/
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $b = Brand::where('id',$pro->braind_id)->first();
                $pro->brandName = $b ? $b->name_en : '';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                        //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }
    public function onlineGet(){
    	try {
           $data['product'] = Product::get();
            foreach ($data['product'] as  $pro) {
              /*  $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
                $pro->unit = Unit::where('id',$pro->unit_id)->first();
                $pro->category = Category::where('id',$pro->category_id)->first();
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }*/
                /*product detail*/
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $b = Brand::where('id',$pro->braind_id)->first();
                $pro->brandName = $b ? $b->name_en : '';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                        //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }
    public function officailStore(){
    	try {
           $data['product'] = Product::get();
            foreach ($data['product'] as  $pro) {
              /*  $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
                $pro->unit = Unit::where('id',$pro->unit_id)->first();
                $pro->category = Category::where('id',$pro->category_id)->first();
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }*/
                /*product detail*/
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $b = Brand::where('id',$pro->braind_id)->first();
                $pro->brandName = $b ? $b->name_en : '';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                        //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }
    public function toabaoCollection(){
    	try {
           $data['product'] = Product::get();
            foreach ($data['product'] as  $pro) {
              /*  $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
                $pro->unit = Unit::where('id',$pro->unit_id)->first();
                $pro->category = Category::where('id',$pro->category_id)->first();
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }*/
                /*product detail*/
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $b = Brand::where('id',$pro->braind_id)->first();
                $pro->brandName = $b ? $b->name_en : '';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                        //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }
    public function getVendor($id){
        try {
            $data = Vendors::where('status', '1')
            ->where('user_id', $id)
            ->first();

            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    public function userhelp(){
        try {
            $data['helps'] = UserHelp::where('status',1)->select('id','title','des')->get();
            foreach ($data['helps'] as  $help) {
                $help->des = UserHelp::where('id',$help->id)->first()->des;
                if ($help->image == "1") {
                    $help->img = $help->image == "1" ? $this->URL . '/uploads/helps/' . $help->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($help->image == "0"){
                    $help->img = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $help->img = $this->URL . '/uploads/helps/' . $help->image;
                }
            }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    public function popular(){
    	try {
    	   $data['product'] = Orders::select('orders.product_id','products.name_en','products.image','products.id')
            ->join('products', 'products.id', 'orders.product_id')
            ->groupBy('orders.product_id','products.name_en', 'products.image','products.id')
            ->take(4)
            ->get();
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }
    public function registation(Request $request)
    {
        
        if($request->email != null){
            $exit = User::where('email', $request->email)->first();
        }
        if($request->phone != null) {
            $exit = User::where('phone',$request->phone)->first();
        }
        
       
      // dd($request->email,$request->phone);
       /* $validator = Validator::make($request->all(), [ 
          'email' => 'required|unique:users,email',
          'password' => 'required',
          'username' => 'required',
      ]);*/
      if ($exit != null) { 
        return response()->json([
              'email' => $request->email,
              'username' => $request->username,
              'message' => "Your eamil or phone already exist",
              'code' => 200,
            ], 200);            
      }else{
            $input = $request->all(); 
            $input['password'] = bcrypt($input['password']); 
            $user = new User();
            $user->email = $request->email;
            $user->username = $request->username;
            $user->phone = $request->phone;
            $user->password = $input['password'];
            $user->role = 'buyer';
            $user->status =1;
            $user->save();
          //$user = User::create($input); 
          
          return response()->json([
            'email' => $user->email,
            'username' => $user->username,
            'message' => "You have successfull register",
            'code' => 204,
            ],200 ); 
      }
    }

    public function login(Request $request)
    {
        
        $newuser = User::where('email',$request->email)->orWhere('phone',$request->phone)->first();
      if ($newuser == '') {
         return response()->json([
            'email' => $request->email,
            'phone' =>  $request->phone,
            'username' => $request->username,
            'message' => 'Your don not have an account yet!',
            'code' => 202,
        ], 202);
      }
        if($request->email != null){
            if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            // Authentication passed...
            $user = auth()->user();
            $user->remember_token = str_random(60);
            $user->save();
            return response()->json( [
                'id' =>$user->id,
                'email' =>  $user->email,
                'phone' => $user->phone,
                'username' => $user->username,
                'message' => 'You  have successfull login',
                'code' => 203,
                 ], 203
              ); 
           } 
        }else{
            if(auth()->attempt(['phone' => $request->phone, 'password' => $request->password])){
                $user = auth()->user();
                $user->remember_token = str_random(60);
                $user->save();
            
                return response()->json( [
                'id' =>$user->id,
                'email' =>  $user->email,
                'phone' => $user->phone,
                'username' => $user->username,
                'message' => 'You  have successfull login',
                'code' => 203,
                 ], 203
              ); 
            }
        }
      
      return response()->json([
          'email' => $request->email,
          'phone' =>  $request->phone,
          'username' => $request->username,
          'message' => 'Your eamil or password incorrect',
          'code' => 201,
      ], 201);
       /* try {
            $checkPass =  User::where('email', $request->email)->orWhere('phone',$request->phone)->first();

            if (isset($checkPass)) {
                 $isVerify = password_verify($request->password , $checkPass->password);
                if($isVerify){
                    $data =  User::where('email', $request->email)->first();
                    return response()->json($data);

                }
            }
            return response()->json([]);
        } catch (Exception $e) {
            
        }*/
    }
   /* public function login(Request $request){
      $newuser = User::where('email',$request->email)->orWhere('phone',$request->phone)->first();
      if ($newuser == '') {
         return response()->json([
            'email' => $request->email,
            'username' => $request->username,
            'message' => 'Your don not have an account yet!',
            'code' => 202,
        ], 202);
      }
      if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
        // Authentication passed...
        $user = auth()->user();
        $user->remember_token = str_random(60);
        $user->save();
        return response()->json( [
            'email' => $user->email,
            'username' => $user->username,
            'message' => 'You  have successfull login',
            'code' => 203,
             ], 203
          ); 
       }
      return response()->json([
          'email' => $request->email,
          'username' => $request->username,
          'message' => 'Your eamil or password incorrect',
          'code' => 201,
      ], 201);
    }*/
   public function postStore(Request $request){

        try {
            $arr = array(
                'user_id' => $request->user_id,
                'shop_name' => $request->shop_name, 
                'province_id' => $request->province_id,
                'disctrict_id' => $request->disctrict_id,
                'commune_id' => $request->commune_id,
                'detail' => $request->detail,
                'pic' => 0,
                'idcard' => $request->idcard,
                'store_url' => $request->store_url,
                'status' => 1
                );
           
            $insert = new Vendors($arr);
            $insert->save();

            $path = public_path().'/uploads/vendor/'.$insert->id.'.jpg';
            $imgItm = file_put_contents($path,base64_decode($request->pic));
            if ($imgItm) {
               Vendors::where('user_id',$request->user_id )->update(array('pic' => 1));
            }

            return response()->json($insert);
        } catch (Exception $e) {
            
        }
    }
     public function putVendor(Request $request){

        try {
            $arr = array(
                'id' => $request->id,
                'user_id' => $request->user_id,
                'shop_name' => $request->shop_name, 
                'province_id' => $request->province_id,
                'disctrict_id' => $request->disctrict_id,
                'commune_id' => $request->commune_id,
                'detail' => $request->detail,
                'pic' => 0,
                'idcard' => $request->idcard,
                'store_url' => $request->store_url,
                'status' => 1
                );
            
            Vendors::where('id', $request->id)->update($arr);

            if ($request->pic != '') {
                $path = public_path().'/uploads/vendor/'.$request->id.'.jpg';
                $imgItm = file_put_contents($path,base64_decode($request->pic));

                if ($imgItm) {
                   Vendors::where('user_id',$request->user_id )->update(array('pic' => 1));
                }
            }
           

            return response()->json($arr);
        } catch (Exception $e) {
            
        }
    }
     public function postProducts(Request $request){
       try {
            $arr = array(
                'pcode' => 'IOG-' . rand(10,9999), 
                'category_id' => $request->category_id,
                'parent_category' => $request->category_id,
                'user_id' => $request->user_id,
                'sub_id' => $request->sub_id,
                'braind_id' => $request->braind_id,
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'name_en' => $request->name_en,
                'detail_en' => $request->detail_en,
                'des_en' => $request->des_en,
                'sell_price' => $request->sell_price,
                'model' => $request->model,
                'special' => $request->special,
                'image' => '',
                'max_order' => $request->max_order,
                'status' => 1
            );

            $insert = new Product($arr);
            $insert->save();

            $path = public_path().'/uploads/product/small/'.$insert->id.'.jpg';
            $path_thumb = public_path().'/uploads/product/thumb/'.$insert->id.'.jpg';
            $imgItm = file_put_contents($path,base64_decode($request->image));
            file_put_contents($path_thumb,base64_decode($request->image));
            if ($imgItm) {
               Product::where('id',$insert->id)->update(array('image' => 1));
            }

            return response()->json($insert);
       } catch (Exception $e) {
           
       }
    }
     public function updateProducts(Request $request){
       try {
            $arr = array(
                'id' => $request->id, 
                'pcode' => $request->pcode, 
                'category_id' => $request->category_id,
                'parent_category' => $request->category_id,
                'user_id' => $request->user_id,
                'sub_id' => $request->sub_id,
                'braind_id' => $request->braind_id,
                'supplier_id' => $request->supplier_id,
                'unit_id' => $request->unit_id,
                'name_en' => $request->name_en,
                'detail_en' => $request->detail_en,
                'des_en' => $request->des_en,
                'sell_price' => $request->sell_price,
                'model' => $request->model,
                'special' => $request->special,
                'image' => '',
                'max_order' => $request->max_order,
                'status' => 1
            );

            Product::where('id',$request->id)->update($arr);

            $path = public_path().'/uploads/product/small/'.$request->id.'.jpg';
            $path_thumb = public_path().'/uploads/product/thumb/'.$request->id.'.jpg';
            $imgItm = file_put_contents($path,base64_decode($request->image));
            file_put_contents($path_thumb,base64_decode($request->image));
            if ($imgItm) {
               Product::where('id',$request->id)->update(array('image' => 1));
            }
            return response()->json($arr);
       } catch (Exception $e) {
           
       }
    }
    public function postOrder(Request $request){
        try {
             $arr = array(
                'user_id' => $request->user_id,
                'qty' => $request->qty, 
                'product_id' => $request->product_id,
                'dis_price' => 0.0,
                'variant_id' => $request->variant_id,
                'province_id' => 0,
                'district_id' => $request->district_id,
                'amout' => $request->amout,
                'f_name' => $request->firstName,
                'l_name' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                );
                $order = new Orders($arr);
                $order->save();
            return response()->json([
                    'message_en' => 'Your order success',
                     'message_kh' => 'ការបញ្ជាទិញរបស់អ្នកជោគជ័យ',
                    'code' => 202,
                ], 202
            );
        } catch (Exception $e) {
            
        }

    }
    public function ProductDetail($id,$user_id){
       try {
            $data['product'] = Product::where('id', $id)->select('id','user_id','pcode','name_en','detail_en','des_en','sell_price','model','image')
            ->get();
            foreach ($data['product'] as  $pro) {
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $favorite = UserStore::where('product_id',$pro->id)->where('user_id',$user_id)->where('status','Favorite')->first();
                $pro->favorite = $favorite ? $favorite->actvie : 0;
                
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
       } catch (Exception $e) {
           
       }
    }
     public function category(){
    	try {
           $data = Category::where('status',1)->get();
             foreach ($data as  $c) {
                $c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }
    public function allCategory()
    {
        try {
            $data = Category::where('status',1)->get();

            foreach ($data as  $c) {
                $c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
             }

            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
     public function categoryHome(){
        try {
            $data = Category::where('parent_id', '!=', 0)->where('status',1)->inRandomOrder()->take(6)->get();
             foreach ($data as  $c) {
                $c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
     public function categoryIcon()
    {
        try {
            $data = Category::where('parent_id', '!=', 0)->where('status',1)->get();
            foreach ($data as  $c) {
                $c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
            }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
     public function parentCategory($id,$skip=0)
    {
        try {
             $data['product'] = Product::where('parent_category', $id)->where('status',1)->skip($skip)->take(10)->get();
             foreach ($data['product'] as  $pro) {
              /*  $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
                $pro->unit = Unit::where('id',$pro->unit_id)->first();
                $pro->category = Category::where('id',$pro->category_id)->first();
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }*/
                /*product detail*/
                if ($pro->image == "1") {
                    $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                }else if($pro->image == "0"){
                    $pro->img = $this->URL . '/uploads/default-img.jpg';
                    $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                }else{
                    $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                    $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                }
                $b = Brand::where('id',$pro->braind_id)->first();
                $pro->brandName = $b ? $b->name_en : '';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->total_price = 0;
                if ($compaign != null) {
                   $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $pro->total_price = $price-$price_discount;
                    }
                }
                if ($pro->total_price == 0) {
                    $pro->total_price = $pro->sell_price;
                }
                $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                foreach ($pro->gallery as  $gallery) {
                    if ($gallery->path == "1") {
                    $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    }else if($gallery->path == "0"){
                        $gallery->path = $this->URL . '/uploads/default-img.jpg';
                    }else{
                        $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                        //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                    }
                }
                $product_varaint = Product_varaint::where('product_id',$pro->id)
                ->select('varaint_id')->get();
                $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    public function editUser(Request $request)
    {
        $user = User::find($request->id); 

        if(count($user) != 0)
        {
            if($request->username != null && $request->hasFile('image'))
            {
                $user->username = $request->username;
                $image = $request->file('image');
                $image_name = time().rand(1111, 99999). '.' . $image->getClientOriginalExtension(); 
                $image_path = public_path('/uploads/users/images'); 
                $image->move($image_path, $image_name);
                $user->image = $image_name; 
                $user->image_path = url('/uploads/users/images').'/'.$image_name; 
                $user->save();
                return response()->json( [
                    'id' => $user->id,
                    'message' => 'You have updated successfully',
                    'username' => $user->username,
                    'image' => $user->image,
                    'image_path' => $user->image_path,
                ], 200);   
            }
            else
            {
                if($request->username != null)
                {
                    $user->username = $request->username;
                    $user->image = $user->image; ; 
                    $user->image_path = $user->image_path;
                    $user->save(); 
                    return response()->json( [
                        'id' => $user->id,
                        'message' => 'you have update only username.',
                        'username' => $user->username,
                        'image' => $user->image,
                        'image_path' => $user->image_path,
                    ], 203);   
                }
                else if($request->hasFile('image'))
                {
                    $user->username = $user->username;  
                    $image = $request->file('image');
                    $image_name = time().rand(1111, 99999). '.' . $image->getClientOriginalExtension(); 
                    $image_path = public_path('/uploads/users/images'); 
                    $image->move($image_path, $image_name);
                    $user->image = $image_name; 
                    $user->image_path = url('/uploads/users/images').'/'.$image_name; 
                    $user->save(); 
                    return response()->json( [
                        'id' => $user->id,
                        'message' => 'You have updated only image successfully',
                        'username' => $user->username,
                        'image' => $user->image,
                        'image_path' => $user->image_path,
                    ], 203);   
                }
                else 
                {
                    return response()->json( [
                        'id' => $user->id,
                        'message' => 'You have not updated anything.',
                        'username' => $user->username,
                        'image' => $user->image,
                        'image_path' => $user->image_path,
                    ], 203);   
                }
            }
        }
        return response()->json([
            'id' => $request->id,
            'message' => 'You have not updated anything.',
            'username' => $request->username,
            'image' => '1',
            'image_path' => '1',
        ], 201); 
    }
}
