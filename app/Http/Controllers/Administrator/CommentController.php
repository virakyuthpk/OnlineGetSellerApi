<?php

namespace App\Http\Controllers\Administrator;
use App\Models\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
class CommentController extends Controller
{
	public function listComment(){
		$data['comment'] = Comments::get();
		foreach ($data['comment'] as  $pro) {
        $pro->commnet = Product::where('id',$pro->product_id)->first();
      	}
      return view('administrator.comment.index',$data);
	}
}
