<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Discount;
class DiscountController extends Controller
{
    public function index()
    {
        $data['discount'] = Discount::orderBy('created_at','desc')->get();
        return view('administrator.discount.index',$data);
    }
    public function create()
    {
        $data['id'] = "";
        $data['discount'] = "";
        return view('administrator.discount.create',$data);
    }
    public function store(Request $request,$id=null)
    {
        Discount::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create discount');
        }else{
            return back()->with('message','You have successfully update discount');
        }
    }
    public function edit($id)
    {
        $data['id'] = $id;
        $data['discount'] = Discount::where('id',$id)->first();
        return view('administrator.discount.create',$data);
    }
    public function destroy(Request $request)
    {
        Discount::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Discount::where('id',$id)->first()->status;
        if ($where == 0) {
            Discount::where('id',$id)->update(array('status' => 1));
        }else{
            Discount::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
