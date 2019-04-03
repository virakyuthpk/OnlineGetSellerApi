<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function parentCategory()
    {
        return CategoryResource::collection(
                Category::where('parent_id', 0)->where('sub_id', 0)->get()
            );
    }
    public function category($parent_id = 0)
    {
        if($parent_id != 0){
            return CategoryResource::collection(
                Category::where('parent_id', $parent_id)->where('sub_id', 0)->get()
            );
        }else{
            return response()->json([
                'success' => false,
                'data' => null, 
                'message' => 'Parent cate ID cannot be 0 or null.'
            ]);
        }
        
    }
    public function subCategory($parent_id = 0 , $cate_id = 0)
    {
        if( $parent_id != 0 && $cate_id != 0){
            return CategoryResource::collection(
                Category::where('parent_id',$parent_id)->where('sub_id', $cate_id)->get()
            );
        }else{
            return response()->json([
                'success' => false,
                'data' => null, 
                'message' => 'Parent cate ID and Cate ID cannot be 0 or null.'
            ]);
        }
        
    }
}