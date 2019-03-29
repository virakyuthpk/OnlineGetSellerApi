<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comment';
     public static function insert($value,$id){
        if($id ==  null){
            $com = new Comments();
            $com->product_id = $value['pro_id'];
            $com->des = $value['comment'];
            $com->save();
        }else{
            $com = Comments::find($id);
            $com->product_id = $value['pro_id'];
            $com->des = $value['comment'];
            $com->save();
        }
    }
}
