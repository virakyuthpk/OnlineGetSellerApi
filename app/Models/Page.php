<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';
    public static function insert($value,$id,$filename){
        $title_en = $value['title_en'];
        $title_kh = $value['title_kh'];
        $des_en = $value['des_en'];
        $des_kh = $value['des_kh'];
        if($id == null){
            $p = new Page();
            $p->title_en = $title_en;
            $p->title_kh = $title_kh;
            $p->des_en = $des_en;
            $p->des_kh = $des_kh;
            $p->image = $filename;
            $p->save();
        }else{
            $p = Page::find($id);
            $p->title_en = $title_en;
            $p->title_kh = $title_kh;
            $p->des_en = $des_en;
            $p->des_kh = $des_kh;
            $p->image = $filename;
            $p->save();
        }
    }
    public static function first($id){
        $page = Page::where('id',$id)->first();
        return $page;
    }
}
