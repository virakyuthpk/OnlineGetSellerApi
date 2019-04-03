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
        return UnitResource::collection(Unit::where('status', 1)->get());
    }
}