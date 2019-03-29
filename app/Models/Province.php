<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    public static function insert($value,$id){
        if($id ==  null){
            $pro = new Province();
            $pro->name_en = $value['name_en'];
            $pro->name_kh = $value['name_kh'];
            $pro->status = '1';
            $pro->save();
        }else{
            $pro = Province::find($id);
            $pro->name_en = $value['name_en'];
            $pro->name_kh = $value['name_kh'];
            $pro->status = '1';
            $pro->save();
        }
    }
}
