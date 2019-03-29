<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Gallery;
class PaymentController extends Controller
{
    public function index()
    {
        $payment = Payment::get();
        return view('administrator.payment.index',compact('payment'));
    }
    public function create()
    {
        $data['id'] = '';
        $data['payment'] = '';
        return view('administrator.payment.create',$data);
    }
    public function store(Request $request,$id=null)
    {
        $filename = Gallery::uploadFile('/payment',$request->file('image'),$request->tmp_file);
        Payment::insert($request->all(),$id,$filename);
        if($id == null){
            return back()->with('message','You have successfully create payment');
        }else{
            return back()->with('message','You have successfully update payment');
        }
    }
    public function edit($id)
    {
        $data['payment'] = Payment::where('id',$id)->first();
        $data['id'] = $id;
        return view('administrator.payment.create',$data);
    }
    public function destroy(Request $request)
    {
        $payment = Payment::where('id',$request->id)->first();
        unlink(public_path().'/uploads/payment/'.$payment->image);
        Payment::where('id',$request->id)->delete();
        return 'success';
    }
    public function active(Request $request){
        $id = $request->id;
        $where = Payment::where('id',$id)->first()->status;
        if ($where == 0) {
            Payment::where('id',$id)->update(array('status' => 1));
        }else{
            Payment::where('id',$id)->update(array('status' => 0));
        }
        return 'success';
    }
}
