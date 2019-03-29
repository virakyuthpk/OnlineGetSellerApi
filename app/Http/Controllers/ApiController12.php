<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\Vendor;
use Socialite;

class ApiController extends Controller
{
    public $URL = 'http://onlineget.com';
    // public $URL = 'http://localhost:8000';
    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function onlineGet(){
    	try {
           $data['product'] = Product::inRandomOrder()->take(3)->get();
            foreach ($data['product'] as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }

    public function officailStore(){
    	try {
           $data['product'] = Product::inRandomOrder()->take(3)->get();
            foreach ($data['product'] as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }

    public function popular(){
    	try {
           $data['popular'] = Orders::select('orders.product_id','products.*')
            ->join('products', 'products.id', 'orders.product_id')
            ->groupBy('orders.product_id','products.name_en', 'products.image')
            ->take(4)
            ->get();
            foreach ($data['product'] as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }

    public function collection(){
    	try {
           $data['product'] = Product::inRandomOrder()->take(6)->get();
           foreach ($data['product'] as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }

    public function parentCategory($id)
    {
        try {
             $data['product'] = Product::where('parent_category', $id)->get();
             foreach ($data['product'] as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

    public function toabaoCollection(){
    	try {
           $data['product'] = Product::inRandomOrder()->take(4)->get();
            foreach ($data['product'] as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }

    public function category(){
    	try {
           $data = Category::all();
             foreach ($data as  $c) {
                $c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }

    public function brand(){
		try {
            $data = Brand::get();
            return response()->json($data);       
        } catch (Exception $e) {
            
        }
    }

    public function allCategory()
    {
        try {
            $data = Category::inRandomOrder()->get();

            foreach ($data as  $c) {
                $c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
             }

            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

    public function listProduct($id){
       try {
            $data['product'] = Product::where('category_id', $id)
            ->orWhere('parent_category', $id)
            ->take(6)
            ->inRandomOrder()
            ->get();
            foreach ($data['product'] as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
       } catch (Exception $e) {
           
       }
    }

    public function listAdvanceSearch($search){
        try {
            $data['product'] = Product::where('name_en','like', '%'.$search.'%')
            ->orWhere('detail_en','like', '%'.$search.'%')
            ->orWhere('des_en','like', '%'.$search.'%')
            ->take(6)
            ->inRandomOrder()
            ->get();
            foreach ($data['product'] as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

    // public function listAllProduct(){
    //     try {
    //         $data['product'] = Product::inRandomOrder()
    //         ->take(6)->get();
    //          foreach ($data['product'] as  $pro) {
    //             $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
    //             $pro->unit = Unit::where('id',$pro->unit_id)->first();
    //             $pro->category = Category::where('id',$pro->category_id)->first();
    //             if ($pro->image == "1") {
    //                 $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
    //                 $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
    //             }else if($pro->image == "0"){
    //                 $pro->img = $this->URL . '/uploads/default-img.jpg';
    //                 $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
    //             }else{
    //                 $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
    //                 $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
    //             }

    //          }
    //         return response()->json($data);
    //     } catch (Exception $e) {
            
    //     }
    // }

    public function listAllProduct(){
        try {
            $data['product'] = Product::inRandomOrder()
            ->take(6)->get();
             foreach ($data['product'] as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

    public function getPolicies(){
        try {
            $data = Page::where('id', 3)->first();
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

    public function getHelp(){
        try {
            $data = Page::where('id', "1")->first();
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

    public function registation(Request $request)
    {
        try {
            $checkEmail = User::where('email',$request->email)->first();
            if ($checkEmail != '') {
                  return response()->json("exist");
            }else{
                $arr = array(
                    'username' => $request->userName, 
                    'email' => $request->email, 
                    'role' => $request->userType,
                    'password' => password_hash($request->password, PASSWORD_BCRYPT), 
                    'remember_token' => "",
                    'created_at' => '',
                    'updated_at' => '',
                    'confirm_code' => '9999',
                    'address3' => 'PP',
                    'status' => "1", 
                    );
                $insert = new User($arr);
                $insert->save();
                return response()->json($insert);
        }
        } catch (Exception $e) {
            
        }
    }

    public function login(Request $request)
    {
        try {
            // $check = array('email' => $request->email, 'password' => Hash::check('secret', $request->password));
            // $request = json_decode($_GET['data']);
            // $data = User::where('email' , $request->email)->first();

            // return response()->json($data);
            $checkPass =  User::where('email', $request->email)->first();

            if (isset($checkPass)) {
                 $isVerify = password_verify($request->password , $checkPass->password);

                if($isVerify){
                    $data =  User::where('email', $request->email)->first();
                    return response()->json($data);

                }
            }
            return response()->json([]);
        } catch (Exception $e) {
            
        }
    }

    public function feed(){
       try {
            $data['product'] = Product::inRandomOrder()->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
            foreach ($data['product'] as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
       } catch (Exception $e) {
           
       }
    }

    public function addCart(Request $request)
    {
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

    public function categoryHome(){
        try {
            $data = Category::where('parent_id', '!=', 0)->inRandomOrder()->take(9)->get();
             foreach ($data as  $c) {
                $c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
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
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
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
             $variant = Variant::get();
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

    public function postOrder(Request $request){
        try {
             $arr = array(
                'user_id' => $request->user_id,
                'qty' => $request->qty, 
                'product_id' => $request->product_id,
                'dis_price' => 0.0,
                'variant_id' => $request->variant_id,
                'province_id' => 0,
                'subtotal' => $request->subtotal,
                'district_id' => $request->district_id,
                'des' => '',
                'amout' => $request->amout,
                'f_name' => $request->firstName,
                'l_name' => $request->lastName,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                );


                $order = new Orders($arr);
                $order->save();
            return response()->json($order);
        } catch (Exception $e) {
            
        }

    }

    public function listMyOrder($mail)
    {
        try {

            $data = Product::select('*')->join('orders', 'products.id', 'orders.product_id')
                    ->where('orders.email', $mail)
                    ->get();

            foreach ($data as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

    public function categoryIcon()
    {
        try {
            $data = Category::where('parent_id', '!=', 0)->get();
            foreach ($data as  $c) {
                $c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
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
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
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
                }
                /*product detail*/
                // if ($pro->image == "1") {
                //     $pro->img = $pro->image == "1" ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $pro->image == "1" ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                // }else if($pro->image == "0"){
                //     $pro->img = $this->URL . '/uploads/default-img.jpg';
                //     $pro->imgBig = $this->URL . '/uploads/default-img.jpg';
                // }else{
                //     $pro->img = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     $pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                // }
                // $b = Brand::where('id',$pro->braind_id)->first();
                // $pro->brandName = $b ? $b->name_en : '';
                // $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                // $pro->dis = 0;
                // $pro->total_price = 0;
                // if ($compaign != null) {
                //    $pro->dis = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                //     if($pro->dis != null){
                //         $price = $pro->sell_price;
                //         $percentage = $pro->dis->percentage;
                //         $price_discount = ($price*$percentage)/100;
                //         $pro->total_price = $price-$price_discount;
                //     }
                // }
                // if ($pro->total_price == 0) {
                //     $pro->total_price = $pro->sell_price;
                // }
                // $pro->favorite = UserStore::where('product_id',$pro->id)->count('product_id');
                // $pro->gallery = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type', 'Product')->select('id','path')->get();
                // foreach ($pro->gallery as  $gallery) {
                //     if ($gallery->path == "1") {
                //     $gallery->path = $gallery->path == "1" ? $this->URL . '/uploads/product/thumb/' . $gallery->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                //     }else if($gallery->path == "0"){
                //         $gallery->path = $this->URL . '/uploads/default-img.jpg';
                //     }else{
                //         $gallery->path = $this->URL . '/uploads/product/small/' . $gallery->path;
                //         //$pro->imgBig = $this->URL . '/uploads/product/feature/' . $pro->image;
                //     }
                // }
                // $product_varaint = Product_varaint::where('product_id',$pro->id)
                // ->select('varaint_id')->get();
                // $pro->variant = Variant::whereIn('id',$product_varaint)->select('id','name_en')->get();
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

    public function getUnit(){
        $data = Unit::where('status', "1")->get();

        return response()->json($data);
    }

    public function getVariant()
    {
        try {
            $data = Variant::where('status', "1")->get();

            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

    public function getSuppliers()
    {
        try {
            $data = Supplier::where('status', '1')->get();

            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

    public function getBrand()
    {
        try {
            $data = Brand::where('status', '1')->get();

            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

     public function getDiscount()
    {
        try {
            $data = Discount::where('status', '1')->get();

            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

     public function getProvince()
    {
       try {
            $data = Province::where('status', '1')->get();

            return response()->json($data);
       } catch (Exception $e) {
           
       }
    }

     public function getDistrit()
    {
        try {
            $data = District::where('status', '1')->get();

            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

     public function getCommune()
    {
       try {
            $data = Commune::where('status', '1')->get();

            return response()->json($data);
       } catch (Exception $e) {
           
       }
    }

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
           
            $insert = new Vendor($arr);
            $insert->save();

            $path = public_path().'/uploads/vendor/'.$insert->id.'.jpg';
            $imgItm = file_put_contents($path,base64_decode($request->pic));
            if ($imgItm) {
               Vendor::where('user_id',$request->user_id )->update(array('pic' => 1));
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
            
            Vendor::where('id', $request->id)->update($arr);

            if ($request->pic != '') {
                $path = public_path().'/uploads/vendor/'.$request->id.'.jpg';
                $imgItm = file_put_contents($path,base64_decode($request->pic));

                if ($imgItm) {
                   Vendor::where('user_id',$request->user_id )->update(array('pic' => 1));
                }
            }
           

            return response()->json($arr);
        } catch (Exception $e) {
            
        }
    }

    public function getVendor($id){
        try {
            $data = Vendor::where('status', '1')
            ->where('user_id', $id)
            ->first();

            return response()->json($data);
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

    public function listStoreProduct($uid){
        try {
            $data['product'] = Product::where('user_id', $uid)
            ->where('status', 1)
            ->get();
             foreach ($data['product'] as  $pro) {
                $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
                $pro->unit = Unit::where('id',$pro->unit_id)->first();
                $pro->category = Category::where('id',$pro->category_id)->first()->path;
                $pro->img = $pro->image == 1 ? $this->URL . '/uploads/product/thumb/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                $pro->imgBig = $pro->image == 1 ? $this->URL . '/uploads/product/small/' . $pro->id .'.jpg': $this->URL . '/uploads/default-img.jpg';

             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }

    public function removeProduct($id)
    {
        try {
            $product = Product::where('id',$id)->update(array('status' => 0));
            return response()->json($product);
        } catch (Exception $e) {
            
        }
    }

    public function listVendor(){
        try {
            $data = Vendor::where('status', '1')->inRandomOrder()->take(6)->get();

            foreach ($data as  $v) {
                $v->pic = $v->pic == 1 ? $this->URL.'/uploads/vendor/'.$v->id.'.jpg' : $this->URL . '/uploads/default-img.jpg';
                $v->countPro = Product::where('user_id', $v->user_id)->where('status', 1)->count();
             }
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
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $exit_user = User::where('email',$user->email)->orWhere('social_id',$user->id)->first();
        if ($exit_user == null) {
            $user = User::create([
                'email' => $user->email,
                'username' => $user->name,
                'password' => bcrypt(str_random(6)),
                'social_id' => $user->id,
                'status' => '1',
                'role' => 'member',
            ]);
        }
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

    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
        //return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $exit_user = User::where('email',$user->email)->orWhere('social_id',$user->id)->first();
        if ($exit_user == null) {
            $user = User::create([
                'email' => $user->email,
                'username' => $user->name,
                'password' => bcrypt(str_random(6)),
                'social_id' => $user->id,
                'status' => '1',
                'role' => 'member',
            ]);
        }
        return json_encode([
          'data'=> [
            'social_id' => $user->id,
            'username' => $user->name, 
            'email' => $user->email,
            'token' => (string) $user->token, 
            'avatar' => $user->avatar
          ],
        ]);  
    }
}
