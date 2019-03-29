<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'teams';
    public static  function insert($value,$id,$filename)
    {
        $name_en = $value['name_en'];
        $title_en = $value['title_en'];
        $des_en = $value['des_en'];
        $name_kh = $value['name_kh'];
        $title_kh = $value['title_kh'];
        $des_kh = $value['des_kh'];
        $status = $value['status'];
        if($id == null){
            $te = new Team;
            $te->department_id = $dapartement;
            $te->name_en = $name_en;
            $te->title_en = $title_en;
            $te->des_en = $des_en;
            $te->name_kh = $name_kh;
            $te->title_kh = $title_kh;
            $te->des_kh = $des_kh;
            $te->image = $filename;
            $te->status = $status;
            $te->save();
        }
        else{
        	$te = Team::find($id);
            $te->department_id = $dapartement;
            $te->name_en = $name_en;
            $te->title_en = $title_en;
            $te->des_en = $des_en;
            $te->name_kh = $name_kh;
            $te->title_kh = $title_kh;
            $te->des_kh = $des_kh;
            $te->image = $filename;
            $te->status = $status;
            $te->save();
          	
        }
    } 
}
