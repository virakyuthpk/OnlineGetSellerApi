<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
class ContactController extends Controller
{
    public function index(Request $request)
    {
    	$contact = Address::where('status',1)->select('id','phone','phone1')->get();
        return response()->json([
            'success' => true,
            'data' => $contact
        ]);
    }
}
