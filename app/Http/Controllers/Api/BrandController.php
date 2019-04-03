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
        return BrandResource::collection(
            Brand::where('status', 1)->orderBy('created_at', 'desc')->get()
        );
    }
}