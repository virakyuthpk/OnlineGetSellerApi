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
    public function policy()
    {
    	$policy = Page::select('des_en')->first(7);
    	return response()->json([
            'success' => true,
            'data' => $policy
        ]);    
    }
    public function saleononlineget()
    {
    	$saleononlineget = Page::select('des_en')->first(6);
    	return response()->json([
            'success' => true,
            'data' => $saleononlineget
        ]);    
    }
}
