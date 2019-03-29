<?php

namespace App\Http\Controllers\Administrator;

use App\Models\District;
use App\Models\Province;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictController extends Controller
{
     public function index()
    {
        $data['province'] = Province::get();
        $data['district'] = District::get();
        return view('administrator.district.index',$data);
    }
    public function create()
    {
        $data['id'] = "";
        $data['district'] = "";
        $data['province'] = Province::get();
        return view('administrator.district.create',$data);
    }
    public function store(Request $request,$id=null)
    {
        District::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create district');
        }else{
            return back()->with('message','You have successfully update district');
        }

    }
    public function edit($id)
    {
        $data['id'] = $id;
        $data['district'] = District::where('id',$id)->first();
        $data['province'] = Province::get();
        return view('administrator.district.create',$data);
    }
    public function destroy(Request $request)
    {
        District::where('id',$request->id)->delete();
        return 'success';
    }
    public function actived(Request $request){
        $id = $request->id;
        $where = District::where('id',$id)->first()->status;
        if ($where == 0) {
            District::where('id',$id)->update(array('status' => 1));
        }else{
            District::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
