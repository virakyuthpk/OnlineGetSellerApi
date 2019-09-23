<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
class CategoryController extends Controller
{
	public $URL = 'https://onlineget.com';
    public function index()
    {
    	$category = Category::select('id','title_en','benner')->where('parent_id',0)->where('sub_id',0)->where('status', '1')->get();
        foreach ($category as  $cat) {
            $cat->path = $cat->benner? $this->URL.'/uploads/icon/'.$cat->benner : $this->URL . '/uploads/default-img.jpg';
        }
        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }
}