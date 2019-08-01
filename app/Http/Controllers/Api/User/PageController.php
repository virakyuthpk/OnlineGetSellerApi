<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
class PageController extends Controller
{
    public function index()
    {
    	$policy = Page::where('id',7)->select('title_en','des_en')->first();
        return response()->json([
            'success' => true,
            'data' => $policy
        ]);
    }
}
