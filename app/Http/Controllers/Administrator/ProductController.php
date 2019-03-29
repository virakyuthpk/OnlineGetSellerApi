<?php

namespace App\Http\Controllers\Administrator;
use Intervention\Image\Facades\Image;
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
use App\Models\Product_varaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Orders;
class ProductController extends Controller
{
    public function index(){
      $data['product'] = Product::orderBy('id','DESC')->get();
      foreach ($data['product'] as  $pro) {
        $pro->supplier = Supplier::where('id',$pro->supplier_id)->first();
        $pro->unit = Unit::where('id',$pro->unit_id)->first();
        $pro->category = Category::where('id',$pro->category_id)->first();
      }
    	return view('administrator.product.index',$data);
    }
    public function create($id=null){
    	$data['id'] = $id;
    	$data['product'] = Product::where('id',$id)->first();
      $data['photos'] = Gallery::where('galleryable_id',$id)->where('galleryable_type',"=","Product")->get();
    	$data['category'] = Category::where('parent_id',0)->get();
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
          $data['subcate'] = Category::where('id',$data['product']->parent_category )->where('sub_id','=',0)->get();
          //dd($data['subcate']);
      }
      if ($data['id'] != null) {
          $data['child'] = Category::where('id',$data['product']->sub_id)->get();
      }
    	return view('administrator.product.create',$data);
    }
    public function addPhotosProduct(Request $request)  
     {
       $this->validate($request, [  
         'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',  
       ]);  
        //— loop through files and upload to users folder and save
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
    public function postProduct(Request $request){
    	$id = $request->id;
        $filename = Gallery::uploadFile('/product/feature',$request->file('image'),$request->tmp_file);
        if($filename == null){
             return back()->with('message','Submited failed! Please select product feature.');
        }else{
             if($id == null){
            $p = new Product();
            $p->pcode = $request->pcode;
            $p->status = 1;
           	$p->name_en = $request->product_name;
            $p->sell_price = $request->sell_price?$request->sell_price:false;
            $p->name_kh = $request->product_kh;
            $p->detail_kh = $request->detail_kh;
            $p->des_en = $request->des_en;
            $p->image = $filename;
            $p->special = $request->special;
            $p->des_kh = $request->des_kh;
            $p->detail_en = $request->detail_en;
            $p->category_id = $request->category;
            $p->parent_category = $request->subcat;
            $p->sub_id = $request->child;
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
          if($request->discount != 0){
              $dis = new Campaign();
              $dis->product_id = $p->id;
              $dis->discount_id = $request->discount;
              $dis->save();
          }
        return redirect()->route('create-product',$data['pro_id'])->with('message','You have successfully create product');
        }else{
            $p = Product::find($id);
            $p->pcode = $request->pcode;
            $p->status = 1;
            //dd($request->pcode);
           	$p->name_en = $request->product_name;
            $p->name_kh = $request->product_kh;
            $p->sell_price = $request->sell_price?$request->sell_price:false;
            $p->special = $request->special;
            $p->detail_kh = $request->detail_kh;
            $p->detail_en = $request->detail_en;
            $p->image = $filename;
            $p->des_en = $request->des_en;
            $p->des_kh = $request->des_kh;
            $p->category_id = $request->category;
            $p->parent_category = $request->subcat;
            $p->sub_id = $request->child;
            $p->braind_id = $request->brand;
            $p->supplier_id = $request->supplier;
            $p->unit_id = $request->unit;
            $p->model = $request->model;
            $p->max_order = $request->max_order;
            $p->save();
            //dd($request->discount);
            if($request->discount != 0){
                $pro_dis =  Campaign::where('discount_id',$request->discount)->where('product_id',$id)->first();
                 if($pro_dis == ''){
                    //dd($request->discount);
                    $dis = new Campaign();
                    $dis->product_id = $p->id;
                    $dis->discount_id = $request->discount;
                    $dis->save();
                 }else{
                    $dis = Campaign::where('discount_id',$pro_dis->discount_id)->update(array(
                    'product_id' => $p->id,
                    'discount_id' => $request->discount
                    ));
                 }
              
            }elseif($request->discount == 0){
                $pro_dis =  Campaign::where('product_id',$id)->first();
                if($pro_dis != null){
                   Campaign::where('discount_id',$pro_dis->discount_id)->delete();
                }
            }
            //die();
            $data['pro_id'] = $p->id;
            $id = $p->id;
            $value = $request->p_id;
            $delete = Product_varaint::whereIn('product_id',$value)->delete();
           /* $i = 0;
            $count = count($value);
            while($i < $count){
                $data1[] = array(
                  'product_id' =>$request->id,
                  'varaint_id' => $value[$i],
                );
                $i++;
            }
            Product_varaint::insert($data1);*/
            $variant_id = $request->variant;
            $data['pro_id'] = $p->id;
            foreach($variant_id as $val){
            $con = new Product_varaint;
            $con->product_id =$id ;
            $con->varaint_id = $val;
            $con->save();
          }
            return redirect()->route('create-product',$data['pro_id'])->with('message','You have successfully update product');
        }
        }
    }
    public function productorder(){
      $data['order'] = Orders::orderBy('created_at','DESC')->get();
      foreach ($data['order'] as $ord) {
        $ord->product = Product::where('id',$ord->product_id)->select('sell_price','pcode','image')->first();
        //dd($ord->product);
      }
      //die();
      return view('administrator.userorder.index',$data);
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
}
