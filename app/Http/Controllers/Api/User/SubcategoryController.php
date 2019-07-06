<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
class SubcategoryController extends Controller
{
    public $URL = 'https://onlineget.com';
    public function index(Request $request)
    {
    	$subcategory = Category::select('id')->where('parent_id',$request->category_id)->get();
        foreach ($subcategory as  $cat) {
            $cat->path = $cat->benner? $this->URL.'/uploads/category/'.$cat->benner : $this->URL . '/uploads/default-img.jpg';
        }
        return response()->json([
            'success' => true,
            'data' => $subcategory
        ]);
    }
}
