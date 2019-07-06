<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advertise;
class AdvertiseController extends Controller
{
    public $URL = 'https://onlineget.com';
    public function index()
    {
    	$advertise = Advertise::select('id','name','image','link')->where('status', '1')->get();
        foreach ($advertise as  $ads) {
            $ads->path = $ads->image? $this->URL.'/uploads/advertise/'.$ads->image : $this->URL . '/uploads/default-img.jpg';
        }
        return response()->json([
            'success' => true,
            'data' => $advertise
        ]);
    }
}
