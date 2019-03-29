<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';
    public static function insert($value,$id){
        if($id ==  null){
            $dis = new District();
            $dis->province_id = $value['province'];
            $dis->name_en = $value['name_en'];
            $dis->name_kh = $value['name_kh'];
            $dis->status = '1';
            $dis->save();
        }else{
            $dis = District::find($id);
            $dis->province_id = $value['province'];
            $dis->name_en = $value['name_en'];
            $dis->name_kh = $value['name_kh'];
            $dis->status = '1';
            $dis->save();
        }
    }
}
