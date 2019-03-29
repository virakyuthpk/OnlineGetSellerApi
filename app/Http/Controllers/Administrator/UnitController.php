<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Unit;
class UnitController extends Controller
{
    public function index(){
		$data['unit'] = Unit::get();
		return view('administrator.unit.index')->with($data);
	}
	public function create(){
    	$data['id'] = '';
        $data['unit'] = '';
    	return view('administrator.unit.create')->with($data);
    }
    public function store(Request $request,$id=null) {
        Unit::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create unit');
        }else{
            return back()->with('message','You have successfully update unit');
        }
    }
    public function edit($id) {
        $data['unit'] = Unit::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.unit.create',$data);
    }
    public function destroy(Request $request)
    {
        Unit::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Unit::where('id',$id)->first()->status;
        if ($where == 0) {
            Unit::where('id',$id)->update(array('status' => 1));
        }else{
            //return $id;
            Unit::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
