<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
     protected $table = 'villeegs';
    public static function insert($value,$id){
        if($id ==  null){
            $vil = new Village();
            $vil->commune_id = $value['commune'];
            $vil->province_id = $value['pro_id'];
            $vil->disctrict_id = $value['destrict'] ;
            $vil->name_en = $value['name_en'];
            $vil->name_kh = $value['name_kh'];
            $vil->save();
        }else{
            $vil = Village::find($id);
            $vil->commune_id = $value['commune'];
            $vil->province_id = $value['pro_id'];
            $vil->disctrict_id = $value['destrict'] ;
            $vil->name_en = $value['name_en'];
            $vil->name_kh = $value['name_kh'];
            $vil->save();
        }
    }
}
