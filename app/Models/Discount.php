<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';
    public static function insert($value,$id){
        if($id ==  null){
            $dis = new Discount();
            $dis->percentage = $value['percentage'];
            $dis->status = '1';
            $dis->save();
        }else{
            $dis = Discount::find($id);
            $dis->percentage = $value['percentage'];
            $dis->status = '1';
            $dis->save();
        }
    }
}
