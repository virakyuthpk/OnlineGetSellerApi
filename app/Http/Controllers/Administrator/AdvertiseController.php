<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Advertise;
use App\Models\Gallery;
use File;
class AdvertiseController extends Controller
{
	public function index(){
		$data['advertise'] = Advertise::get();
		return view('administrator.advertise.index')->with($data);
	}
    public function create(){
    	$data['id'] = '';
        $data['advertise'] = '';
    	return view('administrator.advertise.create')->with($data);
    }
    public function store(Request $request,$id=null) {
        $filename = Gallery::uploadFile('/advertise',$request->file('fileImage'),$request->tmp_file);
        Advertise::insert($request->all(),$id,$filename);
        if($id == null){
            return back()->with('message','You have successfully create advertise');
        }else{
            return back()->with('message','You have successfully update advertise');
        }
    }
    public function edit($id) {
        $data['advertise'] = Advertise::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.advertise.create',$data);
    }
    public function destroy(Request $request)
    {
        $add = Advertise::where('id',$request->id)->first();
        $file= $add->image;
        $filename = public_path().'/uploads/advertise/'.$file;
        \File::delete($filename);
        
        ///unlink(public_path().'/uploads/advertise/'.$add->image);
        Advertise::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Advertise::where('id',$id)->first()->status;
        if ($where == 0) {
            Advertise::where('id',$id)->update(array('status' => 1));
        }else{
            //return $id;
            Advertise::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
