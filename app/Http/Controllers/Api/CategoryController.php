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
        $data = Category::where('parent_id', 0)->where('sub_id', 0)->get();
        return response()->json([
            'success' => true,
            'data' => CategoryResource::collection($data), 
            'message' => 'Here are the parent category list.'
        ]);
    }
    public function category($parent_id = 0)
    {
        if($parent_id != 0){
            $data = Category::where('parent_id', $parent_id)->where('sub_id', 0)->get();
            return response()->json([
                'success' => true,
                'data' => CategoryResource::collection($data), 
                'message' => 'Here are the category list.'
            ]);
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
            $data = Category::where('parent_id',$parent_id)->where('sub_id', $cate_id)->get();
            return response()->json([
                'success' => true,
                'data' => CategoryResource::collection($data), 
                'message' => 'Here are the sub category list.'
            ]);
        }else{
            return response()->json([
                'success' => false,
                'data' => null, 
                'message' => 'Parent cate ID and Cate ID cannot be 0 or null.'
            ]);
        }
        
    }
}