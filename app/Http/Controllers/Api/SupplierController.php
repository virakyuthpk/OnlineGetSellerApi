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
        return SupplierResource::collection(
            Supplier::where('status',1)->orderBy('id', 'asc')->get()
        );
    }
}