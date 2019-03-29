<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Visitor;
class VisitorController extends Controller
{
    public function index(){
        $data['visitor'] = Visitor::orderBy('id','DESC')->get();
        return view('administrator.visitor.index',$data);
    	
    }
}
