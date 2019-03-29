<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Gallery;
class TeamController extends Controller
{
    public function index(){
        $data['team'] = Team::get();
        return view('administrator.team.index',$data);
    }
    public function create(){
        $data['id'] = '';
        $data['team'] = '';
        return view('administrator.team.create',$data);
    }
    public function store(Request $request,$id=null){
        $filename = Gallery::uploadFile('/teams',$request->file('image'),$request->tmp_file);
        Team::insert($request->all(),$id,$filename);
        if($id == null){
            return back()->with('message','You have successfully create team');
        }else{
            return back()->with('message','You have successfully update team');
        }
    }
    public function edit($id){
        $data['team'] = Team::where('id',$id)->first();
        $data['id'] = $id;
        $data['departement'] = Department::get();
        return view('administrator.team.create',$data);
    }
    public function destroy(Request $request)
    {
        Team::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Team::where('id',$id)->first()->status;
        if ($where == 0) {
            Team::where('id',$id)->update(array('status' => 1));
        }else{
            Team::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
