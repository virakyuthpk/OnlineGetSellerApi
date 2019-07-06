<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slide;
class SlideController extends Controller
{
	public $URL = 'https://onlineget.com';
    public function index()
    {
    	$slides = Slide::select('id','image')->where('status', '1')->get();
        foreach ($slides as  $slid) {
            $slid->path = $slid->image? $this->URL.'/uploads/slideshow/'.$slid->image : $this->URL . '/uploads/default-img.jpg';
        }
        return response()->json([
            'success' => true,
            'data' => $slides
        ]);
    }
}
