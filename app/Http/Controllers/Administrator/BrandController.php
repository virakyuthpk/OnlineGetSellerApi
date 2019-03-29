<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Gallery;
use File;
class BrandController extends Controller
{
    public function index(){
		$data['brand'] = Brand::get();
		return view('administrator.brand.index')->with($data);
	}
	public function create(){
    	$data['id'] = '';
        $data['brand'] = '';
    	return view('administrator.brand.create')->with($data);
    }
    public function store(Request $request,$id=null) {
        $filename = Gallery::uploadFile('/brand',$request->file('fileImage'),$request->tmp_file);
        Brand::insert($request->all(),$id,$filename);
        if($id == null){
            return back()->with('message','You have successfully create brand');
        }else{
            return back()->with('message','You have successfully update brand');
        }
    }
    public function edit($id) {
        $data['brand'] = Brand::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.brand.create',$data);
    }
    public function destroy(Request $request)
    {
        $brand = Brand::where('id',$request->id)->first();
        $file= $brand->image;
        $filename = public_path().'/uploads/brand/'.$file;
        \File::delete($filename);
        
        //unlink(public_path().'/uploads/brand/'.$add->image);
        Brand::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Brand::where('id',$id)->first()->status;
        if ($where == 0) {
            Brand::where('id',$id)->update(array('status' => 1));
        }else{
            //return $id;
            Brand::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
