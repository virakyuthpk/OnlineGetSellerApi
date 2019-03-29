<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Slide;
use App\Models\Category;
use App\Models\Advertise;
use App\Models\Partner;
use App\Models\Address;
use App\Models\Orders;
use Carbon\Carbon;
use App\Models\Page;
use App\Models\Payment;
use DB;
use App\Models\Product;
use App\Models\Visitor;
use App\Models\Leftslide;
use App\Models\Logo;
use App\Models\Vendors;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
     public function __construct(){
        $this->middleware(function ($request, $next) {
            $page_name = \Request::segment(1); 
            $this->page_title = "";
             $page_name = \Request::segment(1); 
            $this->page_title = "";
            if ($page_name == 'howtobuy') {
                $this->page_title = Page::first(1);
            }
            if($page_name == 'return'){
                $this->page_title = Page::first(3);
            }
            if ($page_name == 'dilivery'){
                $this->page_title = Page::first(2);
            }
            if ($page_name == 'aboutus'){
                $this->page_title = Page::first(4);
            }
            if ($page_name == 'career'){
                $this->page_title = Page::first(5);
            }
            $this->payment = Payment::get();
            $this->slide = Slide::where('status',1)->get();
             /* main */  $this->category = Category::where('status',1)->where('parent_id','=',0)->get();
            foreach ($this->category as  $cate) {
                 $cate->subcate = Category::where('parent_id',$cate->id)
                ->where('sub_id','=',0)->where('status',1)
                ->get();
                /*child*/
                foreach ($cate->subcate as $sub_cats) {
                    $sub_cats->child = Category::where('sub_id',$sub_cats->id)->where('status',1)->get();
                }
               
            }
            /*$this->category = Category::where('status',1)->where('parent_id','=',0)->get();
            foreach ($this->category as  $cate) {
                $cate->subcate = Category::where('status',1)->where('parent_id',$cate->id)->take(10)->get();
            }*/
            $this->slide = Slide::where('status',1)->get();
            
            $this->add_left_top = Advertise::where('position','Left Top')->get();
            $this->add_left_butom = Advertise::where('position','Left Buttom')->get();
            $this->add_top = Advertise::where('position','Center')->first();
            $this->partner = Partner::where('status',1)->get();
            $this->address = Address::first();
            $this->payment = Payment::get();
            $this->product_left = Leftslide::where('status',1)->take(2)->get();
            $this->visitlog = Visitor::count();
            $this->data = DB::table("orders")
            ->select(DB::raw("product_id, COUNT(product_id) as count_row"))
            ->groupBy('product_id')
            ->groupBy(DB::raw("month(created_at)"))
            ->whereMonth('created_at',date('m'))
            ->get();
            $this->count_ad = Visitor::where('os','Android')->whereDay('created_at', '=', date('d'))->count();
            $this->count_iphone = Visitor::where('os','iPhone')->whereDay('created_at', '=', date('d'))->count();
            $this->count_computer = Visitor::where('os','!=','iPhone')->whereDay('created_at','=', date('d'))->where('os','!=','Android')->count();
            $this->total_today = Visitor::whereDay('created_at', '=', date('d'))->count();
            /*total*/
             $this->count_ad_total = Visitor::where('os','Android')->count();
            $this->count_iphone_total = Visitor::where('os','iPhone')->count();
            $this->count_computer_total = Visitor::where('os','!=','iPhone')->where('os','!=','Android')->count();
            $this->total = Visitor::count();
            foreach ($this->data as  $value) {
                $value->pup_product = Product::where('id',$value->product_id)->select('image','sell_price','id','name_en','name_kh')->get();
            }
            $this->logo = Logo::first();
            $this->shops = Vendors::where('status',1)->select('id','shop_name','pic','shop_cover')->inRandomOrder()->take(10)->get();
            view()->share(['slide' => $this->slide,'category'=> $this->category,'add_left_top' => $this->add_left_top,'add_left_butom' => $this->add_left_butom,'partner' => $this->partner,'address' => $this->address,'add_top'=>$this->add_top,'page_title' => $this->page_title,'payment' => $this->payment,'data' => $this->data,'product_left'=> $this->product_left,'visitlog' => $this->visitlog,'count_ad' => $this->count_ad,'count_iphone' => $this->count_iphone,'count_computer'=>$this->count_computer,'total_today'=> $this->total_today,'count_ad_total'=>$this->count_ad_total,'count_iphone_total'=>$this->count_iphone_total,'count_computer_total'=>$this->count_computer_total,'total'=>$this->total,'logo'=>$this->logo,'shops'=>$this->shops]);
            return $next($request);
        });
    }
}
