<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    public static function insert($value,$id,$filename){
        $name_en = $value['name_en'];
        $name_kh = $value['name_kh'];
        if($id  == null){
            $pay = new Payment();
            $pay->name_en = $name_en;
            $pay->name_kh = $name_kh;
            $pay->image = $filename;
            $pay->status = 1;
            $pay->save();
        }else{
        	Payment::where('id',$id)->update(array(
				'name_en' 	  =>  $name_en,
				'name_kh' =>  $name_kh,
				'image' => $filename,
				'status' => 1,
			));
        }
    }
}
