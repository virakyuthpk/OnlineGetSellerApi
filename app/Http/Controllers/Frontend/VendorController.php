<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand; 
use App\Models\Unit;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Discount;
use Validator;
use App\Models\Category;
use App\Models\District;
use App\Models\Commune;
use App\Models\Vendors;
use App\Models\Province;
use App\Models\Supplier;
use Hash;
use App\Models\Gallery;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Models\Product_varaint;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Profile;
use App\Models\Orders;
use Auth;
class VendorController extends Controller
{
     public function index(){
      $data['product'] = Product::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
      foreach ($data['product'] as  $pro) {
        $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
        $pro->unit = Unit::where('id',$pro->unit_id)->first();
        $pro->category = Category::where('id',$pro->category_id)->first();
      }
    	return view('front.vendor.product.index',$data);
    }
    public function create($id=null){
    	$data['id'] = $id;
    	$data['product'] = Product::where('id',$id)->first();
      	$data['photos'] = Gallery::where('galleryable_id',$id)->where('galleryable_type',"=","Product")->get();
     	// $data['category'] = Category::get();
      	$data['variant'] = Variant::get();
      	
    	$data['brand'] = Brand::get();
      	$data['discount'] = Discount::get();
    	$data['unit'] = Unit::get();
    	$data['supplier'] = Supplier::get();
      	$data['procut_dis'] = 0;
      	$data['campage'] = Campaign::where('product_id',$data['product']['id'])->first();
      	if ($data['campage'] != null) {
        $data['procut_dis'] = $data['campage']['discount_id'] ;
      	}else{
         $data['procut_dis'] = 0;
      	}
      	$data['product_varaint'] = Product_varaint::where('product_id',$data['product']['id'])
      	->select('varaint_id')->get();
      	if ($data['id'] != null) {
         $data['subcate'] = Category::where('parent_id',$data['product']->parent_category )->get();
      	}
    return view('front.vendor.product.create')->with($data);
    }
     public function postProduct(Request $request){
    	$id = $request->id;
      	$filename = Gallery::uploadFile('/product/feature',$request->file('image'),$request->tmp_file);
    	  if($id == null){
            $p = new Product();
            $p->pcode = $request->pcode;
           	$p->name_en = $request->product_name;
            $p->sell_price = $request->sell_price?$request->sell_price:false;
            $p->name_kh = $request->product_kh;
            $p->detail_kh = $request->detail_kh;
            $p->des_en = $request->des_en;
            $p->image = $filename;
            $p->user_id = Auth::user()->id;
            $p->special = $request->special;
            $p->des_kh = $request->des_kh;
            $p->detail_en = $request->detail_en;
            $p->category_id = $request->subcat;
            $p->parent_category = $request->category;
            $p->braind_id = $request->brand;
            $p->supplier_id = $request->supplier;
            $p->unit_id = $request->unit;
            $p->model = $request->model;
            $p->max_order = $request->max_order;
          	$p->save();
            $id = $p->id;
            $variant_id = $request->variant;
          	$data['pro_id'] = $p->id;
            foreach($variant_id as $val){
            $con = new Product_varaint;
            $con->product_id =$id ;
            $con->varaint_id = $val;
            $con->save();
          }
          if($request->discount != ''){
              $dis = new Campaign();
              $dis->product_id = $p->id;
              $dis->discount_id = $request->discount;
              $dis->save();
          }
        //         $appId = '703917776438362';
        // $appSecret = '323686446e4e4616ce35b801797aca7e';
        // $pageId = '206098536640481';
        // $userAccessToken = 'EAAKANaEEBFoBAGdW9h7FDeFC575vzO3F9PLkJIoXyGZCPoUprT9zEMNen9Xd2ZCZCY5N1Kaxoo5i4ZBQ1JWt7lx981q2asOl35FYdvqXv1Sionn0GByIZCpyfHjSqyZBdJ1R4YsMl9bSlVYjEw0UZB6SGMzh1q71VpZCoYyLlaZBhUXJ2iZBUSAEdBnSzTj7LMBTLzH6XZBXkB1FgZDZD';
        //    $fb = new Facebook\Facebook([
        //     'app_id' => $appId,
        //     'app_secret' => $appSecret,
        //     'default_graph_version' => 'v2.5'
        // ]);
        // $longLivedToken = $fb->getOAuth2Client()->getLongLivedAccessToken($userAccessToken);

        // $fb->setDefaultAccessToken($longLivedToken);

        // $response = $fb->sendRequest('GET', $pageId, ['fields' => 'access_token'])
        //     ->getDecodedBody();
        // $foreverPageAccessToken = $response['access_token'];
        
        // $fb->setDefaultAccessToken($foreverPageAccessToken);
        // $fb->sendRequest('POST', "$pageId/feed", [
        //     'message' => 'I Like French Fries.',
        //     'link' => 'sustinatgreen.thurawadh.com',
        // ]);
        // var_dump($fb->sendRequest('GET', '/debug_token', ['input_token' => $foreverPageAccessToken])->getDecodedBody());
        return redirect()->route('create-vendor-product',$data['pro_id'])->with('message','You have successfully create product');
        }else{
            $p = Product::find($id);
            $p->pcode = $request->pcode;
            //dd($request->pcode);
           	$p->name_en = $request->product_name;
            $p->name_kh = $request->product_kh;
            $p->sell_price = $request->sell_price?$request->sell_price:false;
            $p->special = $request->special;
            $p->detail_kh = $request->detail_kh;
            $p->detail_en = $request->detail_en;
            $p->image = $filename;
            $p->des_en = $request->des_en;
            $p->user_id = Auth::user()->id;
            $p->des_kh = $request->des_kh;
            $p->category_id = $request->subcat;
            $p->parent_category = $request->category;
            $p->braind_id = $request->brand;
            $p->supplier_id = $request->supplier;
            $p->unit_id = $request->unit;
            $p->model = $request->model;
            $p->max_order = $request->max_order;
            $p->save();
            if($request->discount != 0){
              $pro_dis =  Campaign::where('discount_id',$request->discount)->where('product_id',$id)->first()->discount_id;
              $dis = Campaign::where('discount_id',$pro_dis)->update(array(
                'product_id' => $p->id,
                'discount_id' => $request->discount
                ));
            }
            $data['pro_id'] = $p->id;
            $id = $p->id;
            $value = $request->p_id;
            $delete = Product_varaint::whereIn('product_id',$value)->delete();
            /*$i = 0;
            $count = count($value);
            while($i < $count){
                $data1[] = array(
                  'product_id' =>$request->id,
                  'varaint_id' => $value[$i],
                );
                $i++;
            }
*/
            $variant_id = $request->variant;
            $data['pro_id'] = $p->id;
            foreach($variant_id as $val){
            $con = new Product_varaint;
            $con->product_id =$id ;
            $con->varaint_id = $val;
            $con->save();
          }

            //Product_varaint::insert($data1);
            return redirect()->route('create-vendor-product',$data['pro_id'])->with('message','You have successfully update product');
        }
    }
     public function OrderList(){
        $data['order_history'] = Orders::where('shop_id',Auth::user()->id)->get();
          foreach ($data['order_history'] as  $pro) {
        $pro->product = Product::where('id',$pro->product_id)->first();
 
      }
      return view('front.vendor.orderlist.index')->with($data);
    }
     public function profile(){
        $users=User::where('id','=',Auth::user()->id)->get();
        $user_id = Auth::user()->id;
        $profile=Profile::where('user_id','=',Auth::user()->id)->first();
          foreach ($users as $user) {
          $user->profile = Profile::where('user_id',$user->id)->first();
         }
        // $user = User::with('profile')->findOrFail($user_id);
        $data =array(
          'user'=>$user,
          );
      return view('front.vendor.profile.index',compact('profile','users'))->with($data);
    }
       public function updatePass(Request $request){
      $id = Auth::user()->id;
      $user_password = Auth::user()->password;
      $new_pass = bcrypt($request->pwd);
      $filename = Gallery::uploadFile('/profile',$request->file('fileImage'),$request->tmp_file);
         Profile::where('user_id',$id)->update(['image'=>$filename]);
       $rules = array(
            'oldpass' => 'required',
            'pwd' => 'required',
            'cpwd' => 'required|same:pwd'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }else{
            if (!Hash::check(Input::get('oldpass'), $user_password)) {
                return Redirect::back()->with('errorpassword','Please input correct password');
            }else{
                $user = User::find($id);
                $user->password = $new_pass;
                $user->save();
                // die();
                return Redirect::back()->with('message','Your password has changed');
            }
        } 
    }
    public function venAccount(Request $request){
      $data['vendor'] = Vendors::where('user_id',Auth::user()->id)->first();
      // dd($data['vendor']);
      $data['product'] = Product::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
      // dd( $data['product']);
      $data['profile']=Profile::where('user_id','=',Auth::user()->id)->first();
      $data['count'] = Product::where('user_id',Auth::user()->id)->count();
      $data['countorder'] = Orders::where('shop_id',Auth::user()->id)->count();
      foreach ($data['product'] as  $pro) {
        $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
        $pro->unit = Unit::where('id',$pro->unit_id)->first();
        $pro->category = Category::where('id',$pro->category_id)->first();
      }
      return view('front.vendor.setting.index')->with($data);
    }
    public function venConfig(Request $request){
      $data['id'] = "";
        $data['district']=District::get();
        $data['province'] = Province::get();
        $data['commune'] = Commune::get();
        $data['vendor'] = Vendors::where('user_id',Auth::user()->id)->first();
        $data['village'] ="";
      return view('front.vendor.setting.config.index')->with($data);
    }
      public function postVenConfig(Request $request){
      $id=$request->id;
       $filename = Gallery::uploadFile('/shop',$request->file('image'),$request->tmp_file);
      $shop = new Vendors();
      if ($id == null) {
      $shop->shop_name=$request->shop_name;
      $shop->province_id=$request->pro_id;
      $shop->disctrict_id=$request->destrict;
      $shop->commune_id=$request->commune;
      $shop->detail=$request->des;
      $shop->pic=$filename;
      $shop->idcard=$request->idcard;
      $shop->store_url=$request->url;
      $shop->user_id=Auth::user()->id;
      $shop->status=1;
      $shop->save();
      $data['pro_id'] = $shop->id;
      return redirect()->route('vendor-config',$data['pro_id'])->with('message',"You have successfully");
      }else{
      $shop = Vendors::find($id);
      $shop->shop_name=$request->shop_name;
      $shop->province_id=$request->pro_id;
      $shop->disctrict_id=$request->destrict;
      $shop->commune_id=$request->commune;
      $shop->detail=$request->des;
      $shop->pic=$filename;
      $shop->idcard=$request->idcard;
      $shop->store_url=$request->url;
      $shop->user_id=Auth::user()->id;
      $shop->status=1;
      $shop->save();
      // dd($shop);
       $data['pro_id'] = $shop->id;
      }
      return redirect()->route('vendor-config',$data['pro_id'])->with('message',"You have successfully");
    }
     public function uploadProductPhotoss(Request $request){
        $pro_id= $request->pro_id;
        $image_name = $request->image_name;
        foreach($image_name as $val){
            $file = new Gallery;
            $file->path =$val ;
            $file->galleryable_id = $pro_id;
            $file->galleryable_type= 'Product';
            $file->save();
        }
       return "successfully";
    } 
     public function addPhotosProduct(Request $request)  
     {
       $this->validate($request, [  
         'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',  
       ]);  
        //— loop through files and upload to all file to folder and save
        $file_array = array();
       foreach($request->file('image') as $image)
       {
          $fileName = md5($image->getFilename().time()).'.'.$image->getClientOriginalExtension();
          $destinationPath =  public_path('uploads') . '/product';
          $image_large = Image::make($image->getRealPath())->resize(1024, 1024);
          $image_small = Image::make($image->getRealPath())->resize(500, 500);
          $image_thumb = Image::make($image->getRealPath())->resize(100, 100);
          $image_large->save($destinationPath . '/large/' . $fileName, 100);
          $image_small->save($destinationPath . '/small/' . $fileName, 100);
          $image_thumb->save($destinationPath . '/thumb/' . $fileName, 100);

          $destinationPath = public_path('uploads') . '/product/photoalbum'; 
          $image->move($destinationPath,$fileName );
          array_push($file_array,$fileName);
       }
        return json_encode($file_array);
     } 
      public function removePhotoPro(Request $request){
        $ex_id = $request->id;
        foreach($ex_id as $ex){
            Gallery::where('id',$ex)->where('galleryable_type',"=","Product")->delete();
        }
    }
     public function deletePro(Request $request){
        $id = $request->id;       
        Gallery::where('galleryable_id',$id)->where('galleryable_type',"=","Product")->delete();
           Product::where('id',$id)->delete();
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Product::where('id',$id)->first()->status;
        if ($where == 0) {
            Product::where('id',$id)->update(array('status' => 1));
        }else{
            Product::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
        public function subcategory($id){
        $subcat =  Category::where('parent_id',$id)->get();
        return json_encode($subcat);
    }
    public function vendorlist(){
        $data['vendors'] = Vendors::get();
        foreach ($data['vendors'] as $vendor) {
            $vendor->user = User::where('id',$vendor->user_id)->first();
        }
        return view('administrator.vendor.index')->with($data);
    }
    public function activevendor(Request $request){
        $id = $request->id;
        $where = Vendors::where('id',$id)->first()->status;
        if ($where == 0) {
            Vendors::where('id',$id)->update(array('status' => 1));
        }else{
            //return $id;
            Vendors::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
