<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    public static function insert($value,$id){
        $name_en = $value['name_en'];
        $name_kh = $value['name_kh'];
        $mobile = $value['mobile'];
        $email = $value['email'];
        $address = $value['address'];
        $detail = $value['detail'];
        if($id  == null){
            $cus = new Customer();
            $cus->name_en = $name_en;
            $cus->name_kh = $name_kh;
            $cus->mobile = $mobile;
            $cus->email = $email;
            $cus->address = $address;
            $cus->detail = $detail;
            $cus->status = 1;
            $cus->save();

        }else{
        	Customer::where('id',$id)->update(array(
				'name_en' =>  $name_en,
				'name_kh'	=> $name_kh,
                'mobile' => $mobile,
                'email' => $email,
                'address' => $address,
                'detail' => $detail,
				'status' => 1,
			));
        }
    }
}
