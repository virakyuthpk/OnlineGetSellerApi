<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    protected $table = 'variants';
    public static function insert($value,$id){
        $name_en = $value['name_en'];
        $name_kh = $value['name_kh'];
        if($id  == null){
            $bra = new Variant();
            $bra->name_en = $name_en;
            $bra->name_kh = $name_kh;
            $bra->status = 1;
            $bra->save();
        }else{
        	Variant::where('id',$id)->update(array(
				'name_en' =>  $name_en,
				'name_kh'	=> $name_kh,
				'status' => 1,
			));
        }
    }
}
