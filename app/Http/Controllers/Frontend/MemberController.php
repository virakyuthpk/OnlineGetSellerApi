<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Discount;
use App\Models\Orders;
use App\Models\Campaign;
use Auth;
use App\Models\Province;
use App\Models\District;
use Validator;
use App\Models\Variant;
use Hash;
use App\Models\Profile;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Payment;
use App\Models\Product_varaint;
class MemberController extends Controller
{  
    public function accSetting(){
        $data['user']=User::where('id','=',Auth::user()->id)->get();
         $data['profiles']=Profile::where('user_id','=',Auth::user()->id)->first();
      return view('front.member.acc_setting')->with($data);
    } 
    public function updateAccount(Request $request){
        $id=Auth::user()->id;
        User::where('id',$id)->update(['email'=>$request->email]);
            Profile::where('user_id',$id)->update(['phone'=>$request->telephone,'first_name'=>$request->firstname,'last_name'=>$request->lastname]);
        
        return back()->with('message',"Update Success...");
    }  
    public function updateAccPass(Request $request){
        $id=Auth::user()->id;
        User::where('id',$id)->update(['password'=>(bcrypt($request->pass))]);
        return back()->with('message',"Update Success...");
    } 
    public function orderhistory(){
        $data['product'] = Orders::where('user_id',Auth::user()->id)->get();
        foreach ($data['product'] as $pro) {
            $pro->detail = Product::where('user_id',Auth::user()->id)->where('id',$pro->product_id)->first();   
        }
    	return view('front.member.order-history')->with($data);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('member-login');
    }
     public function myformAjax($id){
        $subcat =  District::where('province_id',$id)->get();
        return json_encode($subcat);
    }  
    public function order($id){
        $product = Product::find($id);
        $producting = Product::where('id',$id)->get();
        $payment = Payment::get();
        $province = Province::get();
        $district = District::get();
         $product_varaint = Product_varaint::where('product_id',$id)
        ->select('varaint_id')->get();
         $variant = Variant::whereIn('id',$product_varaint)->get();
         //$variant = Variant::get();
        //       $total_price = '';
        $total_price = '';
        foreach ($producting as $pro) {
            $pro->compaign = Campaign::where('product_id',$pro->id)->first();
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

        $data = array(
            'product' => $product,
            'producting' => $producting,
            'variant' => $variant,
            'district' => $district,
            'province' => $province,
            'payment' => $payment,
        );
        return view('front.member.order')->with($data);
    }
    public function postOrder(Request $request){
        
        // $user_id = Auth::user()->id;
        $product= $request->product_id;
        $qty= $request->quantity;
        $max_order= $request->max_order;
        // if($qty<$max_order || $max_order == '0' ) {
            $toatal = $max_order-$qty;
            Product::where('id',$product)->update(['max_order'=>$toatal]);
            $order = new Orders();
            if (Auth::check()) {
                $order->user_id= Auth::user()->id;
            }
            $order->qty=$qty;
            $order->product_id=$product;
            $order->dis_price=$request->dis_count;
            $order->variant_id=$request->option;
            $order->province_id=$request->provice;
            $order->subtotal=$request->subtotal;
            $order->district_id=$request->destric;
            $order->des=$request->comments;
            $order->amout=$request->sell_price;
            $order->f_name=$request->firstname;
            $order->l_name=$request->lastname;
            $order->email=$request->email;
            $order->phone=$request->phone;
            $order->address=$request->address;
            $order->save();
            $data = Input::all();
            return view('wing_form')->with('data', $data);
        // }
        
        // return $data;
        // if ($data['optradio'] = 4){
        //     return view('wing_form')->with('data', $data);
        // }
        // return back()->with('message',"You have already orders");
        // }
        // else{ 
        //     return back()->with('message',"You can not orders");
        // }
    }
}
