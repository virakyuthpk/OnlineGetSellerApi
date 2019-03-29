<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Supplier;
class SupplierController extends Controller
{
   public function index(){
		$data['supplier'] = Supplier::get();
		return view('administrator.supplier.index')->with($data);
	}
	public function create(){
    	$data['id'] = '';
        $data['supplier'] = '';
    	return view('administrator.supplier.create')->with($data);
    }
    public function store(Request $request,$id=null) {
        Supplier::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create supplier');
        }else{
            return back()->with('message','You have successfully update supplier');
        }
    }
    public function edit($id) {
        $data['supplier'] = Supplier::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.supplier.create',$data);
    }
    public function destroy(Request $request)
    {
        Supplier::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Supplier::where('id',$id)->first()->status;
        if ($where == 0) {
            Supplier::where('id',$id)->update(array('status' => 1));
        }else{
            //return $id;
            Supplier::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
