<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Report;
use Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function redirect(){
        return view('wing_form');
    }
    public function success_pay(Request $request)
    {
        $restApiKey = "c97ef9524653ae24a660b3910f7f8de98addc6470aa3ddaa4e5253b3c8707c52";
        $encrypted = $request->contents;
        
        $key =pack('H*', hash('sha256', $restApiKey));
        $iv = array_fill(0,16,chr(0));
        $iv1=implode('',$iv);
        $decryptedData = openssl_decrypt(base64_decode($encrypted), "AES-256-CBC", $key, OPENSSL_RAW_DATA, $iv1);
        $d = "$decryptedData";
        
        $data = json_decode($d);
        $report = new Report;
        $report->amount=$data->amount;
        $report->total=$data->total;
        $report->customer_name=$data->customer_name;
        $report->transaction_id=$data->transaction_id;
        $report->biller_name=$data->biller_name;
        $report->user_id = (int)$data->remark;
        // Log::info($report);
        $report->save();
    }
    public function back()
    {
        return view('back_wing'); 
    }
    public function appreturnpayment(){
         return view('front.page.returnPayment');
    }
    // public function store(){
    //     $getData = Input::all();
    //     // $data = response()->json($getData);
    //     $data = json_encode($getData);
    //     return view('outdata')->with('data', $data);
    // }
    public function oursarathCallback()
    {
        return 'testing';   
    }
}
