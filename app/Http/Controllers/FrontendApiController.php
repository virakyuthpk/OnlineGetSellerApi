<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand; 
use App\Models\Unit;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Discount;
use App\Models\Category;
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
use App\Models\Vendors;
use App\Models\UserHelp;
use App\Models\Slide;
use App\Models\Review;
use Auth;
use Hash;
use App\Mail\MemberResetPassword;
use Mail;
use App\Models\PasswordReset;
class FrontendApiController extends Controller
{
    public function __construct(){
        $this->middleware('guest')->except('logout');
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
    /*category*/
    public function category($skip=0){
    	try {
           $data['category'] = Category::select('id','title_en')->where('parent_id',0)->where('sub_id',0)->orderBy('id','desc')->skip($skip)->take(10)->get();
             foreach ($data['category'] as  $c) {
                $c->icon = $c->icon ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
             }
            return response()->json($data); 
        } catch (Exception $e) {
            
        }
    }
    // review and rating 
   
    // public function reviewProduct(Request $request)
    // {
    //     $user_id = $request->user_id; 
       
    //     $product_id = $request->product_id; 
    //     $rating = $request->rating; 
    //     $cmt = $request->cmt; 
    //     $review = new Review; 
    //     $review->user_id = $user_id; 
    //     $review->product_id = $product_id; 
    //     $review->rating = $rating; 
    //     $review->comment = $cmt; 
    //     $review->save(); 
    //      return $review; 
    //     return [
    //         'message' => 'success',
    //     ];
        
    // }
    /*parent category*/
    public function parentCategory($id,$skip =0){
        try {
            $data['parent_category'] = Category::where('parent_id', $id)->where('sub_id',0)->select('id','title_en')->orderBy('id','desc')->skip($skip)->take(10)->get();
            foreach ($data['parent_category'] as  $parent_cat) {
                $parent_cat->image = $parent_cat->image ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
            }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    /*child category*/
    public function childCategory($id,$skip =0){
        try {
            $data['child_category'] = Category::where('sub_id', $id)->select('id','title_en')->orderBy('id','desc')->skip($skip)->take(10)->get();
            foreach ($data['child_category'] as  $parent_cat) {
                $parent_cat->image = $parent_cat->image ? $this->URL . '/uploads/icon/' . $c->icon : $this->URL . '/uploads/default-img.jpg';
            }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    /* list product*/
    public function listAllProduct($skip=0){
        try {
            $data['product'] = Product::select('id','sell_price','name_en','image')->orderBy('id','desc')->skip($skip)->take(10)->get();
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
                    $pro->discount_price =  (int)$pro->sell_price;
                }
             }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    /*product detail*/
    public function ProductDetail($id){
       try {
            $data['product'] = Product::where('id', $id)->select('id','user_id','pcode','name_en','detail_en','des_en','sell_price','model','image')
            ->get();
            foreach ($data['product'] as  $pro) {
                $pro->image_path = $pro->image ? $this->URL . '/uploads/product/feature/' . $pro->image : $this->URL . '/uploads/default-img.jpg';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->discount_price = 0;
                if ($compaign != null) {
                  $discount = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                     $discount = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                    if($discount != null){
                        $price = $pro->sell_price;
                        $pro->dis = (int)$discount->percentage;
                        $price_discount = ($price* $discount->percentage)/100;
                        $pro->discount_price = (int)$price-$price_discount;
                    }
                }
                if ($pro->discount_price == 0) {
                    $pro->discount_price =  (int)$pro->sell_price;
                }
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

    /*add cart*/
    public function addCart(Request $request){
        try {
            
            // $exist =  UserStore::where('user_id',$request->user_id)->where('product_id',$request->product_id)->where('status','Cart')->first();
            // //$qty = 0;
            // if($exist != null){
            //   $id =  $exist->id;
            //   $qty = $request->qty+$exist->qty;
            //   $variant_id =$exist->variant_id;
              
            //   $insert = UserStore::find($id);
            //   $insert->user_id = $exist->user_id;
            //   $insert->product_id = $exist->product_id;
            //   $insert->status = $exist->status;
            //   $insert->active = $exist->active;
            //   $insert->qty =  $qty;
            //   $insert->variant_id = $request->variant_id;
            //   $insert->save();
            // }else{
            //     $arr = array(
            //     'user_id' => $request->user_id, 
            //     'product_id' => $request->product_id, 
            //     'status' => $request->status,
            //     'active' => "1",
            //     'qty' =>$request->qty,
            //     'variant_id' => $request->variant_id,
            //     );
            //     $insert = new UserStore($arr);
            //     $insert->save();
            // }
            //  return ['message' => 'success',];
            $inCart  = UserStore::where('product_id',$request->product_id)->where('user_id',$request->user_id)->where('variant_id', $request->variant_id)->where('status', 'Cart')->first();
            if($inCart == null){
                $newCart = new UserStore; 
                $newCart->user_id = $request->user_id;
                $newCart->product_id = $request->product_id;
                $newCart->status = $request->status;
                $newCart->variant_id = $request->variant_id;
                $newCart->qty = $request->qty;
                $newCart->save(); 
                return [
                    'message' => 'added successful',
                ];
            }
            else
            {
                $inCart->qty = $inCart->qty +  $request->qty;
                $inCart->save(); 
                return [
                     'message' => 'added successful',
                ];
            }
        } catch (Exception $e) {
            
        }
    }
    /*login*/
    public function login(Request $request){
      $newuser = User::where('email',$request->email)->orWhere('phone',$request->phone)->first();
      if (empty($newuser)) {
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
            'id' => $user->id,
            'email' => $user->email,
            'username' => $user->username,
            'image_path' => $user->image_path,
            'message' => 'You  have successfull login',
            'code' => 203,
             ], 203
          ); 
      	}else{
      		return response()->json([
	          'email' => $request->email,
	          'username' => $request->username,
	          'message' => 'Your eamil or password incorrect',
	          'code' => 201,
	      	], 201);
      	}
    }
    /*register*/
    public function register(Request $request){
        try {
            $checkEmail = User::where('email',$request->email)->first();
            if ($checkEmail != '') {
                  return response()->json([
                        'message' => 'Your account already exist',
                	    'username' => $request->username,
                	    'image_path' =>  $checkEmail->image_path,
                	    'code' => 	"201",
                	]);
            }else{
                // $arr = array(
                // 	'phone' => $request->phone,
                //     'username' => $request->username,
                //     'email' => $request->email, 
                //     'role' => $request->role,
                //     'image_path' => url('uploads/users/images/noimage.png'), 
                //     'password' => password_hash($request->password, PASSWORD_BCRYPT), 
                //     'remember_token' => str_random(60),
                //     'status' => "1", 
                //     );
                $insert = new User;
                $insert->phone = $request->phone;
                $insert->username = $request->username;
                $insert->email = $request->email;
                $insert->role = $request->role;
                $insert->image_path = url('uploads/users/images/noimage.png'); 
                $insert->password = password_hash($request->password, PASSWORD_BCRYPT);
                $insert->remember_token = str_random(60);
                $insert->status = "1";
                $insert->save();
                return response()->json([
                    	'message' => 'You have successfull create account',
                	    'username' => $insert->username,
                	    'image_path' => $insert->image_path,
                	    'code' => 	"200",
                    ]	);
        	}
        } catch (Exception $e) {
            
        }
    }
    /*new arrived*/
    public function newarrived($skip=0){
    	try {
            $data['product'] = Product::where('status',1)->whereMonth('created_at',date('m'))->select('id','sell_price','name_en','image')->orderBy('id','desc')->skip($skip)->take(10)->get();
             foreach ($data['product'] as  $pro) {
                $pro->image_path = $pro->image ? $this->URL . '/uploads/product/feature/' . $pro->image : $this->URL . '/uploads/default-img.jpg';
                $compaign = Campaign::where('status',1)->where('category_id',$pro->category_id)->orWhere('product_id',$pro->id)->first();
                $pro->dis = 0;
                $pro->discount_price = 0;
                $re = Review::where('product_id', $pro->id)->get();
	               if($re->isEmpty())
	               { 
	                   $pro->rating = 0;
	               
	               }
	               else
	               {
	                    foreach($re as $r)
	                    {
	                        $ra =Review::where('product_id', $pro->id)->sum('rating');
	                        
	                        $pro->rating = $ra/count($re); 
	                    }
	               }
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
    /*page*/
    public function page($id){
    	try {
            $data['page'] = Page::where('id',$id)->select('id','title_en','des_en','image')->get();
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
    /*offer product*/
    public function Promotion(){
    	try {
            $compaign = Campaign::get();
            $data['products'] = [];
	        foreach ($compaign as $com) {
	           $data['products'] = Product::where('id',$com->product_id)->orWhere('category_id',$com->category_id)->select('id','name_en','sell_price','image','category_id')->get();
	           foreach ($data['products'] as $com_dis) {
	              $compaign = Campaign::where('status',1)->where('category_id',$com_dis->category_id)->orWhere('product_id',$com_dis->id)->select('discount_id')->first();
	               $com_dis->dis = 0;
	               $re = Review::where('product_id', $com_dis->id)->get();
	               if($re->isEmpty())
	               { 
	                   $com_dis->rating = 0;
	               
	               }
	               else
	               {
	                    foreach($re as $r)
	                    {
	                        $ra =Review::where('product_id', $com_dis->id)->sum('rating');
	                        
	                        $com_dis->rating = $ra/count($re); 
	                    }
	               }
	                   
	                if ($compaign->discount_id != null) {
	               		$discount = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
		                if($discount->percentage != null){
		                    if($discount != null){
                                $price = $com_dis->sell_price;
                                $com_dis->dis = (int)$discount->percentage;
                                $price_discount = ($price* $discount->percentage)/100;
                                $com_dis->discount_price = (int)$price-$price_discount;
                            }
		                }
	           		}
	          	}
	        }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
    }
     public function ProductCategory($id,$short,$skip=0){
        try {
             //$data['product'] = Product::where('parent_category', $id)->where('status',1)->orWhere('category_id',$id)->select('id','sell_price','name_en','image')->orderBy('id','desc')->skip($skip)->take(10)->get();
            $product_list = Product::where('parent_category', $id)->where('status',1)->orWhere('category_id',$id)->select('id','sell_price','name_en','image');
            
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
                $pro->dis = 0;
                $pro->discount_price = 0;
                $re = Review::where('product_id', $pro->id)->get();
	               if($re->isEmpty())
	               { 
	                   $pro->rating = 0;
	               
	               }
	               else
	               {
	                    foreach($re as $r)
	                    {
	                        $ra =Review::where('product_id', $pro->id)->sum('rating');
	                        
	                        $pro->rating = $ra/count($re); 
	                    }
	               }
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
    public function ListProductShort($short ,$skip=0){
        try {
            $product_list = Product::select('id','sell_price','name_en','image');
            if($short ==1){
              $data['product']  = $product_list->orderBy('sell_price','desc')->skip($skip)->take(10)->get();
            }elseif($short == 2){
               $data['product']  =  $product_list->orderBy('sell_price','asc')->skip($skip)->take(10)->get();
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
    public function search(Request $request,$skip=0){
        try {
            // return $request->search; 
            if($request->search == null){
                $data['products'] = [];
            }
            else{
                $search = $request->search; 
            $data['products'] = Product::where('name_en','like', '%'.$search.'%')
                ->skip($skip)->take(100)
                ->select('id','category_id','name_en','image')
                ->get();
                foreach ($data['products'] as  $product) {
                    /*product detail*/
                    $product->image_path = $product->image == "1" ? $this->URL . '/uploads/product/feature/' . $product->id .'.jpg': $this->URL . '/uploads/default-img.jpg';
                    $compaign = Campaign::where('status',1)->where('category_id',$product->category_id)->orWhere('product_id',$product->id)->first();
                    $product->dis = 0;
                    $product->discount_price = 0;
                    if ($compaign != null) {
                       $discount = Discount::where('id',$compaign->discount_id)->where('status',1)->select('percentage')->first();
                        if($discount != null){
                            $price = $product->sell_price;
                            $product->dis = (int)$discount->percentage;
                            $price_discount = ($price* $discount->percentage)/100;
                            $product->discount_price = (int)$price-$price_discount;
                        }
                    }
                    if ($product->discount_price == 0) {
                        $product->discount_price = (int)$product->sell_price;
                    }
                }
            }
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
	/*remove favorite*/
    public function removeFavorite($id,$user_id){
        try {
            UserStore::where('product_id',$id)->where('user_id',$user_id)->where('status','Favorite')->delete();
            return response()->json('success');
        } catch (Exception $e) {
            
        }
    }
    /*remove multi favorite*/
    public function removeFavoritemulti($id,$user_id){
        try {
            UserStore::whereIn('product_id',$id)->where('user_id',$user_id)->where('status','Favorite')->delete();
            return response()->json('success');
        } catch (Exception $e) {
            
        }
    }
    /*remove multi card*/
    public function removeCardmulti($id,$user_id){
        try {
            UserStore::whereIn('product_id',[$id])->where('user_id',$user_id)->where('status','Cart')->delete();
            return response()->json('success');
        } catch (Exception $e) {
            
        }
    }
    /*my favorite*/
    public function getMyFavorite($user_id){
        try {
             $data['products'] = UserStore::select('*')->join('products', 'products.id', 'userStores.product_id')
            ->where('userStores.user_id', $user_id)
            ->where('userStores.status', 'Favorite')
            ->select('products.id','products.sell_price','products.name_en','products.image')->orderBy('id','desc')
            ->get();
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
    public function countcard($user_id){
        try {
            $count = UserStore::where('status','Cart')->where('user_id',$user_id)->sum('qty');
           $data['count'] = (int)$count;
            return response()->json($data);
        } catch (Exception $e) {
            
        }
       
    }
    public function totalprice($user_id){
        try {
            $data['usercard'] = UserStore::where('status','Cart')->where('user_id',$user_id)->get();
            foreach ($data['usercard'] as  $usercar) {
                $usercar->product = Product::where('id',$usercar->product_id)->select('sell_price','id')->get();
                //dd($usercar->product);
                 foreach ( $usercar->product as  $p) {
                     $p->total = $p->sell_price*$usercar->qty;
                    
                 }
            }
            return response()->json($data);
        } catch (Exception $e) {
            
        }
       
    }
    public function verifyEmail(Request $request){
        $data = $request->all();
        $email = $data['email'];
        $user = User::where('email',$email)->first();
        if($user){
            Mail::to($email,'Thaok9')->send(new MemberResetPassword($data));
            return response()->json([
                'message' => 'We sent you an email with instructions for resetting your password.Please, check your email.',
                'code' => 203,
             ], 203);
            
        }else{
            return response()->json([
            'message' => 'Your email do not exist',
            'code' => 201,
             ], 201);
        }
    }
    public function resetNewPass(Request $request){
        $token = $request->reset_token;
        $password = $request->password;
        $pass = PasswordReset::where('token',$token)->first();
        if($pass){
            User::where('email',$pass->email)->update(array('password'=>bcrypt($password)));
            PasswordReset::where('token',$token)->delete();
            if (Auth::attempt(['email' => $pass->email, 'password' => $password])) {
                 return response()->json([
                    'message' => 'Your password was reset',
                    'code' => 202,
                 ], 202);
            }
        }else{
            return response()->json([
                    'message' => 'Invalid Token',
                    'code' => 203,
                 ], 203);
            //return redirect()->back()->with('error_message','Invalid Token');
        }
    }
    
}
