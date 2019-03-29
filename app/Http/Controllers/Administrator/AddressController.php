<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
class AddressController extends Controller
{
    public function index(){
        $data['address'] = Address::get();
        return view('administrator.address.index',$data);
    }
    public function create(){
        $data['id'] = '';
        $data['address'] = '';
        return view('administrator.address.create',$data);
    }
    public function store(Request $request,$id=null){
    	Address::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create career');
        }else{
            return back()->with('message','You have successfully update career');
        }
    }
    public function edit($id){
        $data['address'] = Address::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.address.create',$data);
    }
    public function destroy(Request $request)
    {
        Address::where('id',$request->id)->delete();
        return 'success';
    }
}
