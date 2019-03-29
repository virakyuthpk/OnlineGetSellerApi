<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Models\Gallery;
class LogoController extends Controller
{
    public function index(){
		$data['logo'] = Logo::get();
		return view('administrator.logo.index')->with($data);
	}
    public function create(){
    	$data['id'] = '';
        $data['logo'] = '';
    	return view('administrator.logo.create')->with($data);
    }
    public function store(Request $request,$id=null) {
        $filename = Gallery::uploadFile('/logo',$request->file('fileImage'),$request->tmp_file);
        Logo::insert($id,$filename);
        if($id == null){
            return back()->with('message','You have successfully create logo');
        }else{
            return back()->with('message','You have successfully update logo');
        }
    }
    public function edit($id) {
        $data['logo'] = Logo::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.logo.create',$data);
    }
    public function destroy(Request $request)
    {
        $add = Logo::where('id',$request->id)->first();
        unlink(public_path().'/uploads/logo/'.$add->image);
        Logo::where('id',$request->id)->delete();
        return 'success';
    }
}
