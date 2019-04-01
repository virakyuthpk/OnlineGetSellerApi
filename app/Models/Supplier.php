<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'suppliers';
    public static function insert($value,$id){
        $name_en = $value['name_en'];
        $name_kh = $value['name_kh'];
        $mobile = $value['mobile'];
        $email = $value['email'];
        $address = $value['address'];
        $detail = $value['detail'];
        if($id  == null){
            $sup = new Supplier();
            $sup->name_en = $name_en;
            $sup->name_kh = $name_kh;
            $sup->mobile = $mobile;
            $sup->email = $email;
            $sup->address = $address;
            $sup->detail = $detail;
            $sup->status = 1;
            $sup->save();

        }else{
        	Supplier::where('id',$id)->update(array(
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

    /* -------- code version 2.0 -------- */

    // attrbutes 

    protected $hidden = ['created_at' , 'updated_at']; 

    // relationships 

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    // methods
}