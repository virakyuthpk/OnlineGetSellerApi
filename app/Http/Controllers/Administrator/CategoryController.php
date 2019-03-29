<?php

namespace App\Http\Controllers\Administrator;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
class CategoryController extends Controller
{
    public function index(){
    	$data['parent'] = Category::get();
    	return view('administrator.category.index',$data);
    }
    public function create(){
    	$data['cate'] = '';
        $data['id'] = '';
        $data['parent'] = $this->category = Category::where('status',1)->where('parent_id','=',0)->get();//Category::where('parent_id','=',0)->get();
        foreach ($data['parent'] as  $pa) {
            $pa->subcate = Category::where('parent_id',$pa->id)->where('sub_id','=',0)
                ->get();
        }
    	return view('administrator.category.create',$data);
    }
    public function store(Request $request,$id=null){
        $filename = Gallery::uploadFile('/icon',$request->file('image'),$request->tmp_file);
         if($id == null){
            $p = new Category();
            $p->title_kh = $request->title_kh;
            $p->title_en = $request->title_en;
            $p->status = $request->status;
            $p->icon = $filename;
            $p->parent_id = $request->parent;
            $p->sub_id = $request->subcat;
            $p->save();
            return back()->with('message','You have successfully create');
        }else{
            $p = Category::find($id);
            $p->title_kh = $request->title_kh;
            $p->title_en = $request->title_en;
            $p->status = $request->status;
            $p->icon = $filename;
            $p->parent_id = $request->parent;
            $p->sub_id = $request->subcat;
            $p->save();
            return back()->with('message','You have successfully update');
        }
        /*Category::insert($request->all(),$id,$filename);
        if($id == null){
            return back()->with('message','You have successfully create');
        }else{
            return back()->with('message','You have successfully update');
        }*/
    }
    public function edit($id)
    {
        $data['id'] = $id;
        $data['cate'] = Category::find($id);
        $data['parent'] = $this->category = Category::where('status',1)->where('parent_id','=',0)->get();//Category::where('parent_id','=',0)->get();
        foreach ($data['parent'] as  $pa) {
            $pa->subcate = Category::where('parent_id',$data['cate']['parent_id'])->where('sub_id','=',0)
                ->get();
        }
      /*  $data['parent'] = Category::where('parent_id','=',0)->get();
        $data['cate'] = Category::where('id',$id)->first();
        $data['subcate'] = Category::where('parent_id',$data['cate']['parent_id'])->where('sub_id','!=',0)->get();*/
        return view('administrator.category.create',$data);
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Category::where('id',$id)->first()->status;
        if ($where == 0) {
            Category::where('id',$id)->update(array('status' => 1));
        }else{
            Category::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
    public function destroy(Request $request)
    {
        $category = Category::where('id',$request->id)->first();
        if($category->icon != null){
            $file= $category->icon;
            $filename = public_path().'/uploads/icon/'.$file;
            \File::delete($filename); 
        }
        Category::where('id',$request->id)->delete();
        return 'success';
    }
    public function subcategory($id){
        $subcat =  Category::where('parent_id',$id)->where('sub_id','=',0)->get();
        return json_encode($subcat);
    }
    public function childcategory($id){
        $child =  Category::where('sub_id',$id)->get();
        return json_encode($child);
    }
}
