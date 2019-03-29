<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'careers';
    public static function insert($value,$id){
        $title = $value['title'];
        $des = $value['des'];
        $closing_date = $value['closing_date'];
        $public_date = $value['public_date'];
        $term = $value['term'];
        $status= $value['status'];
        if($id == null){
            $ca = new Career();
            $ca->title = $title;
            $ca->des = $des;
            $ca->closing_date = $closing_date;
            $ca->public_date = $public_date;
            $ca->term = $term; 
            $ca->status = $status;
            $ca->save();
        }else{
            $ca = Career::find($id);
            $ca->title = $title;
            $ca->des = $des;
            $ca->closing_date = $closing_date;
            $ca->public_date = $public_date;
            $ca->term = $term;
            $ca->status = $status; 
            $ca->save();
        }
    }
}
