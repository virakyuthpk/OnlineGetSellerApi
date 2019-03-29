<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserHelp;
use App\Models\Gallery;
class HelpController extends Controller
{
    public function index(){
        $data['help'] = UserHelp::where('status',1)->get();
        return view('administrator.help.index',$data);
    }
    public function create(){
        $data['help'] = '';
        $data['id'] = '';
        return view('administrator.help.create',$data);
    }
    public function store(Request $request,$id=null){
        $filename = Gallery::uploadFile('/helps',$request->file('image'),$request->tmp_file);
        UserHelp::insert($request->all(),$id,$filename);
        if($id == null){
            return back()->with('message','You have successfully create');
        }else{
            return back()->with('message','You have successfully update');
        }
    }
    public function edit($id){
        $data['help'] =  UserHelp::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.help.create',$data);
    }
    public function destroy(Request $request){
        UserHelp::where('id',$request->id)->delete();
        return 'success';
    }
}
