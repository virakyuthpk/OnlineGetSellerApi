<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Commune;
use App\Models\Village;
use App\Models\Province;

class VillageController extends Controller
{
     public function index()
    {
        $data['village'] = Village::get();
        return view('administrator.villages.index',$data);
    }
    public function create()
    {
        $data['id'] = "";
        $data['district']=District::get();
        $data['province'] = Province::get();
        $data['commune'] = Commune::get();
        $data['village'] ="";
       return view('administrator.villages.create')->with($data);
    }

    public function store(Request $request,$id=null)
    {
        Village::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create village');
        }else{
            return back()->with('message','You have successfully update village');
        }

    }
    public function edit($id)
    {
        $data['id'] = $id;
        $data['district'] = District::get();
        $data['village'] = Village::where('id',$id)->first();
        $data['commune'] = Commune::get();
        $data['province'] = Province::get();
        return view('administrator.villages.create')->with($data);
    }
    public function destroy(Request $request)
    {
        Village::where('id',$request->id)->delete();
        return 'success';
    }

}
