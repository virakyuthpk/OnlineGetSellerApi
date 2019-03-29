<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Page;
use App\Models\Comments;
use App\Models\Campaign;
use App\Models\Team;
use App\Models\Discount;
use App\Models\Department;
use App\Models\Gallery;
use App\Models\Variant;
use App\Models\Product_varaint;
use App\Http\Controllers\Controller;
use Validator;
use Cart;
use App\Models\District;
use App\Models\Commune;
use App\Models\Subscriber;
use App\Models\Orders;
use DB;
use VisitLog;
use App\Models\Career;
use App\Models\Category;
class FrontendController extends Controller
{
    public function index(){
        VisitLog::save();
        /*$data['product'] = Product::where('special','no')->orderBy('id','DESC')->where('status',1)->simplePaginate(20);
        foreach ($data['product'] as  $pro) {
            $pro->imgcover = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type','Product')->first();
            # code...
        }
        $total_price = '';
        foreach ($data['product'] as $pro) {
            $pro->compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
            if ($pro->compaign != null) {
               $pro->dis = Discount::where('id',$pro->compaign->discount_id)->where('status',1)->first();
                if($pro->dis != null){
                    $price = $pro->sell_price;
                    $percentage = $pro->dis->percentage;
                    $price_discount = ($price*$percentage)/100;
                    $total_price = $price-$price_discount;
                }
            }
        }*/
        
        $data['pcate'] = Category::where('parent_id',0)->where('status',1)->get();
        //dd($data['pcate']);
        //$data['pcate'] = DB::table('categories')->join('products','categories.id','products.parent_category')->select('categories.title_en','categories.title_kh','categories.id')->distinct('products.parent_category')->get();
        foreach ($data['pcate'] as $cate) {
            $cate->product = Product::where('category_id',$cate->id)->orderBy('created_at','DESC')->paginate(8);
            foreach ($cate->product as $pro) {
                $pro->imgcover = Gallery::where('galleryable_id',$pro->id)->where('galleryable_type','Product')->first();
                //dd( $pro->imgcover->path);
                $pro->compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                if ($pro->compaign != null) {
                   $pro->dis = Discount::where('id',$pro->compaign->discount_id)->where('status',1)->first();
                    if($pro->dis != null){
                        $price = $pro->sell_price;
                        $percentage = $pro->dis->percentage;
                        $price_discount = ($price*$percentage)/100;
                        $total_price = $price-$price_discount;
                    }
                }
            }
        }
    	return view('front.home.index',$data);
    }
    public function postsubscrib(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|unique:subscribers,email',
        ]);
        if($validator->fails()){
             return 'error';
        }else{
            $sub = new Subscriber;
            $sub->email = $request->email;
            $sub->save();
            return 'success';
        }
    }
     public function proDetail($id){
        $prodetail = Product::find($id);
        $variant = Variant::get();
        //$product_var = Product_varaint::get();
        $product = Product::where('category_id',$prodetail->category_id)->get();
        $gallery = Gallery::where('galleryable_id',$id)->where('galleryable_type','Product')->first();
        $related =Product::select('name_en','sell_price','des_en','image','id')->where('category_id', $prodetail->category_id)->take(8)->get();
        $pho = Gallery::where('galleryable_id',$id)->where('galleryable_type',"=","Product")->get(); 
        $compaign = Campaign::where('status',1)->where('category_id',$prodetail->category_id)->orWhere('product_id',$prodetail->id)->first();
        //dd($compaign);
        $product_varaint = Product_varaint::where('product_id',$id)
        ->select('varaint_id')->get();
         $variant = Variant::whereIn('id',$product_varaint)->get();
         
        $dis = 0;
        if ($compaign != null) {
           $dis = Discount::where('id',$compaign->discount_id)->where('status',1)->first();
            if($dis != null){
                $price = $prodetail->sell_price;
                $percentage = $dis->percentage;
                $price_discount = ($price*$percentage)/100;
                $total_price = $price-$price_discount;
            }
        }
        $data = array(
            'prodetail' => $prodetail,
            'product' => $product,
            'variant' => $variant,
            'related' => $related,
            'variant' => $variant,
            'pho' => $pho,
            'gallery' => $gallery,
            'dis' => $dis
        );
        return view('front.page.prodetail',$data);
    }
    public function search(Request $request){
       $data['product']=Product::select('id','name_en','name_kh','image','sell_price','pcode','created_at')->where("name_en","like","%{$request->input('search')}%")->orWhere("pcode","like","%{$request->input('search')}%")->simplePaginate(20)/*->get()*/;  
        return view('front.page.product')->with($data);
    }
    public function toBuy(){
        $data['page'] = Page::first(1);
        return view('front.page.howtobuy')->with($data);
    }
     public function retun(){
        $data['page'] = Page::first(3);
        return view('front.page.return')->with($data);
    }
    public function dilive(){
        $data['page'] = Page::first(2);
        return view('front.page.dilivery')->with($data);
    }
    public function Contact(){
        return view('front.page.contactus');
    }
    public function aboutUs(){
        $page = Page::first(4);
        $teams = Team::where('status',1)->get();
         $data = array(
            'page' => $page,
            'teams' => $teams,
            );
        return view('front.page.aboutus')->with($data);
    }
    public function career(){
        $data['career'] = Career::get();
        $data['page'] = Page::first(5);
        return view('front.page.career')->with($data);
    }
    public function sale(){
        $data['page'] = Page::first(6);
        return view('front.page.sale')->with($data);
    }
     public function teamdetail($id){
        $data['team'] = Team::find($id);
         return view('front.page.team-detail')->with($data);
    }
    public function addtocart(Request $request){
            //$image = Product::where('id',$request->id)->first()->image;
            Cart::add($request->id, $request->name, $request->qty, $request->price);
            return redirect()->back();
    }
    public function showcart(){
         return view('front.page.cart');
    }
    public function removecart(Request $request){
        Cart::remove($request->id);
        return redirect()->back();
    }
    public function myformAjax($id){
        $subcat =  District::where('province_id',$id)->get();
        return json_encode($subcat);
    }
    public function commune($id){
        $commune =  Commune::where('district_id',$id)->get();
        return json_encode($commune);
    }
    public function productbycategory($id){
       $data['product']=Product::where('category_id',$id)->orWhere('parent_category',$id)->orWhere('sub_id',$id)->paginate(20);
       $data['ca'] =Category::where('id',$id)->first();
        return view('front.page.product')->with($data);
    }
     public function Comment(Request $request,$id=null)
    {
        Comments::insert($request->all(),$id);
        if($id == null){
           return back()->with('message','Thank You for your comment');
        }else{
            return back()->with('message','You have Comment successfully update');
        }

    }
    public function wingpayment(){
         return view('front.page.wingpayment');
    }
    public function appreturnpayment(){
         return view('front.page.returnPayment');
    }
}
