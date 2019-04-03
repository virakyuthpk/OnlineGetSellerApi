<?php

namespace App\Http\Controllers\Api;

use App\Models\Variant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\VariantResource;

class VariantController extends Controller
{
    public function index()
    {
        return VariantResource::collection(Variant::where('status', 1)->get());
    }
}