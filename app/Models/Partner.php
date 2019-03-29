<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';
    public static function insert($value,$id,$filename){
        $name = $value['name'];
        $url = $value['url'];
        $status = $value['status'];
        if($id == null){
            $mem = new Partner();
            $mem->name = $name;
            $mem->url = $url;
            $mem->image = $filename;
            $mem->status = $status;
            $mem->save();
           
        }else{
            $mem = Partner::find($id);
            $mem->name = $name;
            $mem->url = $url;
            $mem->image = $filename;
            $mem->status = $status;
            $mem->save();
        }
    }
}
