<?php

namespace App\Http\Controllers\Api;

use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DiscountResource;

class DiscountController extends Controller
{
    public function index()
    {
        return DiscountResource::collection(
            Discount::where('status', 1)->orderBy('percentage', 'asc')->get()
        );
    }
}