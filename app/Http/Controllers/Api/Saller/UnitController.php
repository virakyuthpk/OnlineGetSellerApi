<?php

namespace App\Http\Controllers\Api\Saller;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UnitResource;

class UnitController extends Controller
{
    public function index()
    {
        return UnitResource::collection(
            Unit::where('status', 1)->orderBy('created_at', 'desc')->get()
        );
    }
    public function showUnit(Request $request)
    {
        # code...
        $unit = Unit::find($request->unit_id);
        return response()->json([
            'unit' => $unit->name_en
        ]);
    }
}