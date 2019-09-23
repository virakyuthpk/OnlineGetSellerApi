<?php

namespace App\Http\Controllers\Api\Saller;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    public function index()
    {
        return BrandResource::collection(
            Brand::where('status', 1)->orderBy('created_at', 'desc')->get()
        );
    }
    public function showBrand(Request $request)
    {
        # code...
        $brand = Brand::find($request->brand_id);
        return response()->json([
            'brand' => $brand->name_en
        ]);
    }
}