<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public static function insert($value,$id,$filename){
        $title_en = $value['title_en'];
        $title_kh = $value['title_kh'];
        $status = $value['status'];
        $parent = $value['parent'];
        if($id == null){
            $p = new Category();
            $p->title_en = $title_en;
            $p->title_kh = $title_kh;
            $p->status = $status;
            $p->icon = $filename;
            $p->parent_id = $parent;
            $p->save();
        }else{
            $p = Category::find($id);
            $p->title_en = $title_en;
            $p->title_kh = $title_kh;
            $p->status = $status;
            $p->icon = $filename;
            $p->parent_id = $parent;
            $p->save();
        }
    }
    public static function first($id){
        $page = Category::where('id',$id)->first();
        return $page;
    }
}
