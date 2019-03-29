<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    public static function insert($value,$id){
        $email = $value['email'];
        $location_en = $value['location_en'];
        $location_kh = $value['location_kh'];
        $phone = $value['phone'];
        $phone1 = $value['phone1'];
        $phone2 = $value['phone2'];
        $open_en = $value['open_en'];
        $open_kh = $value['open_kh'];
        if($id == null){
            $loca = new Address();
            $loca->email = $email;
            $loca->location_en = $location_en;
            $loca->location_kh = $location_kh;
            $loca->phone = $phone;
            $loca->phone1 = $phone1;
            $loca->phone2 = $phone2; 
            $loca->open_en = $open_en;
            $loca->open_kh = $open_kh;
            $loca->save();
        }else{
            $loca = Address::find($id);
            $loca->email = $email;
            $loca->location_en = $location_en;
            $loca->location_kh = $location_kh;
            $loca->phone = $phone;
            $loca->phone1 = $phone1;
            $loca->phone2 = $phone2; 
            $loca->open_en = $open_en;
            $loca->open_kh = $open_kh;
            $loca->save();
        }
    }
}
