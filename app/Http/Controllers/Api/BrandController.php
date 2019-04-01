<?php

namespace App\Http\Controllers\Api;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    public function index()
    {
        $data = Brand::where('status', 1)->orderBy('created_at', 'desc')->get();
        return response()->json([
            'success' => true, 
            'data' => BrandResource::collection($data),
            'message' => 'Here are brand list.'
        ]);
    }
}