<?php

namespace App\Http\Controllers\Api\Saller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
Use App\Models\Page;
class PageController extends Controller
{
    public function about()
    {
    	$about = Page::select('des_en')->first(4);
    	return response()->json([
            'success' => true,
            'data' => $about
        ]);
    }
    public function term()
    {
    	$term = Page::select('des_en')->first(7);
    	return response()->json([
            'success' => true,
            'data' => $term
        ]);    
    }
}
