<?php

namespace App\Http\Controllers\Administrator;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index(){
        $data['departement'] = Department::get();
        return view('administrator.department.index',$data);
    }
    public function create(){
        $data['departement'] = '';
        $data['id'] = '';
        return view('administrator.department.create',$data);
    }
    public function store(Request $request,$id=null){
        Department::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create');
        }else{
            return back()->with('message','You have successfully update');
        }
    }
    public function edit($id){
        $data['departement'] = Department::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.department.create',$data);
    }
    public function delete(Request $request){
        Department::where('id',$request->id)->delete();
        return 'success';
    }
}

