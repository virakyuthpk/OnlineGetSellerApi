<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\Commune;

class CommuneController extends Controller
{
     public function index()
    {
        $data['province'] = Province::get();
        $data['district'] = District::get();
        $data['commune'] = Commune::get();
        return view('administrator.commune.index',$data);
    }
    public function create()
    {  
        $data['id'] = "";
        $data['commune']="";
        $data['district'] = District::where('status','1')->get();
        $data['province'] = Province::get();
       return view('administrator.commune.create',$data);
    }

    public function store(Request $request,$id=null)
    {
        Commune::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create district');
        }else{
            return back()->with('message','You have successfully update district');
        }

    }
    public function edit($id)
    {
        $data['id'] = $id;
        $data['commune'] = Commune::where('id',$id)->first();
        $data['district'] = District::get();
        $data['province'] = Province::get();
        return view('administrator.commune.create',$data);
    }
    public function destroy(Request $request)
    {
        Commune::where('id',$request->id)->delete();
        return 'success';
    }

}
