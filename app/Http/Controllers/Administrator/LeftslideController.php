<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Leftslide;
use App\Models\Gallery;
class LeftslideController extends Controller
{
    public function index(){
		$data['leftslide'] = Leftslide::get();
		return view('administrator.leftslide.index')->with($data);
	}
    public function create(){
    	$data['id'] = '';
        $data['leftslide'] = '';
    	return view('administrator.leftslide.create')->with($data);
    }
    public function store(Request $request,$id=null) {
        $filename = Gallery::uploadFile('/leftslide',$request->file('fileImage'),$request->tmp_file);
        Leftslide::insert($request->all(),$id,$filename);
        if($id == null){
            return back()->with('message','You have successfully create data');
        }else{
            return back()->with('message','You have successfully update data');
        }
    }
    public function edit($id) {
        $data['leftslide'] = Leftslide::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.leftslide.create',$data);
    }
    public function destroy(Request $request)
    {
        $add = Leftslide::where('id',$request->id)->first();
        unlink(public_path().'/uploads/leftslide/'.$add->image);
        Leftslide::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Leftslide::where('id',$id)->first()->status;
        if ($where == 0) {
            Leftslide::where('id',$id)->update(array('status' => 1));
        }else{
            Leftslide::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
