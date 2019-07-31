<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserHelp;
class HelpController extends Controller
{
    public function index()
    {
    	$help = UserHelp::select('id','title')->where('status', '1')->get();
        return response()->json([
            'success' => true,
            'data' => $help
        ]);
    }
    public function detail(Request $request)
    {
    	$help = UserHelp::where('id',$request->id)->select('id','des')->first();
        return response()->json([
            'success' => true,
            'data' => $help
        ]);
    }
}
