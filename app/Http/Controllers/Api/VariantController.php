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
        $data = Variant::where('status', 1)->get();
        return response()->json([
            'success' => true, 
            'data' => VariantResource::collection($data), 
            'message' => 'Here are variant list.'
        ]);
    }
}