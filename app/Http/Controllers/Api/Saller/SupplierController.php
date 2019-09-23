<?php

namespace App\Http\Controllers\Api\Saller;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;

class SupplierController extends Controller
{
    public function index()
    {
        return SupplierResource::collection(
            Supplier::where('status', 1)->orderBy('created_at', 'desc')->get()
        );
    }
    public function showSupplier(Request $request)
    {
        # code...
        $supplier = Supplier::find($request->supplier_id);
        return response()->json([
            'supplier' => $supplier->name_en
        ]);
    }
}