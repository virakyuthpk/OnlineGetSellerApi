<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Variant;
class VariantController extends Controller
{
    public function index(){
		$data['variant'] = Variant::get();
		return view('administrator.variant.index')->with($data);
	}
	public function create(){
    	$data['id'] = '';
        $data['variant'] = '';
    	return view('administrator.variant.create')->with($data);
    }
    public function store(Request $request,$id=null) {
        Variant::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create variant');
        }else{
            return back()->with('message','You have successfully update variant');
        }
    }
    public function edit($id) {
        $data['variant'] = Variant::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.variant.create',$data);
    }
    public function destroy(Request $request)
    {
        Variant::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Variant::where('id',$id)->first()->status;
        if ($where == 0) {
            Variant::where('id',$id)->update(array('status' => 1));
        }else{
            //return $id;
            Variant::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
