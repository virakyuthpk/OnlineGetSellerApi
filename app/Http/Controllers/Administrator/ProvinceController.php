<?php

namespace App\Http\Controllers\Administrator;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class ProvinceController extends Controller
{
     public function index()
    {
        /*$data['country'] = Country::get();*/
        $data['province'] = Province::orderBy('created_at','desc')->get();
        return view('administrator.province.index',$data);
    }
    public function create()
    {
        $data['id'] = "";
        $data['province'] = "";
      /*  $data['country'] = Country::get();*/
        return view('administrator.province.create',$data);
    }
    public function store(Request $request,$id=null)
    {
        Province::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create province');
        }else{
            return back()->with('message','You have successfully update province');
        }

    }
    public function edit($id)
    {
        $data['id'] = $id;
        $data['province'] = Province::where('id',$id)->first();
        return view('administrator.province.create',$data);
    }
    public function destroy(Request $request)
    {
        Province::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Province::where('id',$id)->first()->status;
        if ($where == 0) {
            Province::where('id',$id)->update(array('status' => 1));
        }else{
            Province::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
