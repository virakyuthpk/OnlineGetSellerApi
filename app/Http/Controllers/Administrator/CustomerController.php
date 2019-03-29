<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
class CustomerController extends Controller
{
    public function index(){
		$data['customer'] = Customer::get();
		return view('administrator.customer.index')->with($data);
	}
	public function create(){
    	$data['id'] = '';
        $data['customer'] = '';
    	return view('administrator.customer.create')->with($data);
    }
    public function store(Request $request,$id=null) {
        Customer::insert($request->all(),$id);
        if($id == null){
            return back()->with('message','You have successfully create customer');
        }else{
            return back()->with('message','You have successfully update customer');
        }
    }
    public function edit($id) {
        $data['customer'] = Customer::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.customer.create',$data);
    }
    public function destroy(Request $request)
    {
        Customer::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Customer::where('id',$id)->first()->status;
        if ($where == 0) {
            Customer::where('id',$id)->update(array('status' => 1));
        }else{
            //return $id;
            Customer::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
