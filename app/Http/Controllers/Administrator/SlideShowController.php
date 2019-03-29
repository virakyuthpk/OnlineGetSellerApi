<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Models\Gallery;
class SlideShowController extends Controller
{
    public function index()
    {
        $slide = Slide::get();
        return view('administrator.slideshow.index',compact('slide'));
    }
    public function create()
    {
        $data['id'] = '';
        $data['slide'] = '';
        return view('administrator.slideshow.create',$data);
    }
    public function store(Request $request,$id=null)
    {
        $filename = Gallery::uploadFile('/slideshow',$request->file('image'),$request->tmp_file);
        Slide::insert($request->all(),$id,$filename);
        if($id == null){
            return back()->with('message','You have successfully create slideshow');
        }else{
            return back()->with('message','You have successfully update slideshow');
        }

    }
    public function edit($id)
    {
        $data['slide'] = Slide::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.slideshow.create',$data);
    }
    public function destroy(Request $request)
    {
        $slide = Slide::where('id',$request->id)->first();
        unlink(public_path().'/uploads/slideshow/'.$slide->images);
        Slide::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Slide::where('id',$id)->first()->status;
        if ($where == 0) {
            Slide::where('id',$id)->update(array('status' => 1));
        }else{
            Slide::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
