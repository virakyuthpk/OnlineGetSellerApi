<?php

namespace App\Http\Controllers\Api\Saller;

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
                'message' => 'Parent ID cannot be 0 or null.'
            ]);
        }
        
    }
    public function subCategory($parent_id = 0 , $sub_id = 0)
    {
        if( $parent_id != 0 && $sub_id != 0){
            return CategoryResource::collection(
                Category::where('parent_id',$parent_id)->where('sub_id', $sub_id)->get()
            );
        }else{
            return response()->json([
                'success' => false,
                'data' => null, 
                'message' => 'Parent ID and Sub ID cannot be 0 or null.',
            ]);
        }
    }
    public function showCategory(Request $request)
    {
        # code...
        $category = Category::find($request->category_id);
        $parent = Category::find($request->parent_id);
        $sub = Category::find($request->sub_id);

        return response()->json([
            'category' => $category->title_en,
            'parent' =>  $parent->title_en,
            'sub' => $sub->title_en
        ]);
    }
}
?>