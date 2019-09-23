<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductsResource;

class ProductController extends Controller
{
    public function index(Product $product, $skip = 0)
    {
        return ProductsResource::collection(
            $product->statusAndOrderWithPaginate($skip)->get()
        );
    }
    public function show(Product $product, $id)
    {
        $product = $product->find($id);
        if($product != null ){
            ProductResource::withoutWrapping();
            return new ProductResource(
                    $product
               );
        }else{
            return [
                'message' => 'Product with your provided ID is not found.',
                'success' => false
            ];
        }
        
    }
    public function store(Request $request, $id = null)
    {
        // mobile data
        $variant_ids = array_map('intval', explode(',', $request->variant));

        $pcode = $request->pcode; 
        $category_id = $request->category_id; 
        $parent_category = $request->parent_category; 
        $user_id = $request->user_id; 
        $sub_id = $request->sub_id; 
        $brand_id = $request->brand_id; 
        $supplier_id = $request->supplier_id; 
        $unit_id = $request->unit_id; 
        $name_en = $request->name_en; 
        $name_kh = $request->name_kh; 
        $detail_en = $request->detail_en; 
        $detail_kh = $request->detail_kh; 
        $des_en = $request->des_en; 
        $des_kh = $request->des_kh; 
        $sell_price = $request->sell_price; 
        $model = $request->model; 
        $special = $request->special; 
        // $image = Gallery::uploadFile('/product/feature',$request->file('image'),$request->tmp_file);
        $max_order = $request->max_order; 
        $status = $request->status;
        // validation
        $messages = [
            'required' => 'The :attribute field is required.',
        ];
        
        $validator = Validator::make($request->all() ,
            [
                // 'pcode' => 'required|unique:products',
                'pcode' => 'required',
                'category_id' => 'required',
                'user_id' => 'required',
                'brand_id' => 'required',
                'supplier_id' => 'required',
                'unit_id' => 'required',
                'name_en' => 'required',
                'sell_price' => 'required',
                'max_order' => 'required',
                
            ], 
            $messages
        );
        if($validator->fails()){
            return response()->json([
                'success' => false,
                'data' => null, 
                'message' => $validator->messages() 
            ]);
        }else{
            if($id == null){
                $product = new Product;
                $product->pcode =  $pcode;
                $product->category_id =  $category_id;
                $product->parent_category =  $parent_category;
                $product->user_id =  $user_id;
                $product->sub_id =  $sub_id;
                $product->braind_id =  $brand_id;
                $product->supplier_id =  $supplier_id;
                $product->unit_id =  $unit_id;
                $product->name_en =  $name_en;
                $product->name_kh =  $name_kh;
                $product->detail_en =  $detail_en;
                $product->detail_kh =  $detail_kh;
                $product->des_en =  $des_en;
                $product->des_kh =  $des_kh;
                $product->sell_price =  $sell_price;
                $product->model =  $model;
                $product->special =  $special;
                // $product->image =  $image;
                $product->max_order =  $max_order;
                $product->status =  $status;
                $product->save();
                 //  picture
                $file_array = array();
                if($request->has('image')){
                    foreach($request->file('image') as $image)
                    {
                        $fileName = Gallery::uploadFile('/product/photoalbum',$image,$request->tmp_file);
                        $file = new Gallery;
                    //  $file->image =$fileName ;
                        $file->path = url('uploads/product/photoalbum').'/'.$fileName;
                        $file->galleryable_id = $product->id;
                        $file->galleryable_type= 'Product';
                        $file->save();
                    }
                }
                return  new ProductResource($product);
            }else{
                $product =  Product::find($id);
                $product->pcode =  $product_code;
                $product->category_id =  $category_id;
                $product->parent_category =  $parent_category;
                $product->user_id =  $user_id;
                $product->sub_id =  $sub_id;
                $product->braind_id =  $brand_id;
                $product->supplier_id =  $supplier_id;
                $product->unit_id =  $unit_id;
                $product->name_en =  $name_en;
                $product->name_kh =  $name_kh;
                $product->detail_en =  $detail_en;
                $product->detail_kh =  $detail_kh;
                $product->des_en =  $des_en;
                $product->des_kh =  $des_kh;
                $product->sell_price =  $sell_price;
                $product->model =  $model;
                $product->special =  $special;
                $product->image =  $image;
                $product->max_order =  $max_order;
                $product->status =  $status;
                $product->save();
                return new ProductResource($product);
            }
        }
    }
}