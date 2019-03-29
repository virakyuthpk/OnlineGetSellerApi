<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Page;

class PagesController extends Controller
{
    public function index(){
        $data['page'] = Page::get();
        return view('administrator.pages.index',$data);
    }
    public function create(){
        $data['page'] = '';
        $data['id'] = '';
        return view('administrator.pages.create',$data);
    }
    public function store(Request $request,$id=null){
        $filename = Gallery::uploadFile('/pages',$request->file('image'),$request->tmp_file);
        Page::insert($request->all(),$id,$filename);
        if($id == null){
            return back()->with('message','You have successfully create');
        }else{
            return back()->with('message','You have successfully update');
        }
    }
    public function edit($id){
        $data['page'] =  Page::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.pages.create',$data);
    }
    public function destroy(Request $request){
        Page::where('id',$request->id)->delete();
        return 'success';
    }

}
