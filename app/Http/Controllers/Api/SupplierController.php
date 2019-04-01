<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;

class SupplierController extends Controller
{
    public function index()
    {
        $data = Supplier::where('status',1)->orderBy('id', 'asc')->get();
        return response()->json([
            'success' => true, 
            'data' => SupplierResource::collection($data),
            'message' => 'Here are the supplier list.'
        ]);
    }
    public function show($id)
    {
        return new SupplierResource(
            Supplier::find($id)
        );
    }
}