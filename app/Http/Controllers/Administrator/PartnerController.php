<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\Gallery;
class PartnerController extends Controller
{
    public function index(){
        $partner = Partner::get();
        return view('administrator.partner.index',compact('partner'));
    }
    public function create() {
        $data['id'] = '';
        $data['partner'] = '';
        return view('administrator.partner.create',$data);
    }
    public function store(Request $request,$id=null)
    {
        $filename = Gallery::uploadFile('/partner',$request->file('image'),$request->tmp_file);
        Partner::insert($request->all(),$id,$filename);
        if($id == null){
            return back()->with('message','You have successfully create');
        }else{
            return back()->with('message','You have successfully update');
        }
    }
    public function edit($id){
        $data['partner'] = Partner::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.partner.create',$data);
    }
    public function destroy(Request $request){
        $partner = Partner::where('id',$request->id)->first();
        unlink(public_path().'/uploads/partner/'.$partner->image);
        Partner::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Partner::where('id',$id)->first()->status;
        if ($where == 0) {
            Partner::where('id',$id)->update(array('status' => 1));
        }else{
            Partner::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
