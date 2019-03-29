<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $table = 'communes';
    public static function insert($value,$id){
        if($id ==  null){
            $com = new Commune();
            $com->district_id = $value['destric'];
            $com->province_id = $value['pro_id'];
            $com->name_en = $value['name_en'];
            $com->name_kh = $value['name_kh'];
            $com->save();
        }else{
            $com = Commune::find($id);
            $com->district_id = $value['destric'];
            $com->province_id = $value['pro_id'];
            $com->name_en = $value['name_en'];
            $com->name_kh = $value['name_kh'];
            $com->save();
        }
    }
}
