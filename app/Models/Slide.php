<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slideshows';
    public static function insert($value,$id,$filename){
        $title = $value['title'];
        $des = $value['des'];
        $status = $value['status'];
        $link = $value['link'];
        if($id == null){
            $sl = new Slide();
            $sl->title = $title;
            $sl->des = $des;
            $sl->image = $filename;
            $sl->status = $status;
            $sl->link = $link;
            $sl->save();
        }else{
            $sl = Slide::find($id);
            $sl->title = $title;
            $sl->des = $des;
            $sl->image = $filename;
            $sl->status = $status;
            $sl->link = $link;
            $sl->save();
        }
    }
}
