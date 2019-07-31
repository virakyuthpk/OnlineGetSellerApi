<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
class PageController extends Controller
{
    public function index()
    {
    	$policy = Page::first(7);
        return response()->json([
            'success' => true,
            'data' => $policy
        ]);
    }
}
