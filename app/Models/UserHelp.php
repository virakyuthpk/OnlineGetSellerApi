<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHelp extends Model
{
    protected $table = 'helps';
    public static function insert($value,$id,$filename){
        $title = $value['title'];
        $des = $value['des'];
        $status = $value['status'];
        if($id == null){
            $help = new UserHelp();
            $help->title = $title;
            $help->des = $des;
            $help->status = $status;
            $help->image = $filename;
            $help->save();
        }else{
            $help = UserHelp::find($id);
            $help->title = $title;
            $help->des = $des;
            $help->status = $status;
            $help->image = $filename;
            $help->save();
        }
    }
}
