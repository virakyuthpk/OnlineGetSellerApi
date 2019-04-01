<?php

namespace App\Http\Controllers\Api;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;

class UnitController extends Controller
{
    public function index()
    {
        $data = Unit::where('status', 1)->get();
        return response()->json([
            'success' => true,
            'data' => UnitResource::collection($data),
            'message' => 'Here are the unit list.'
        ]);
    }
}