<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';
    public static function insert($value,$id){
        $name_en = $value['name_en'];
        $name_kh = $value['name_kh'];
        if($id  == null){
            $bra = new Unit();
            $bra->name_en = $name_en;
            $bra->name_kh = $name_kh;
            $bra->status = 1;
            $bra->save();
        }else{
        	Unit::where('id',$id)->update(array(
				'name_en' =>  $name_en,
				'name_kh'	=> $name_kh,
				'status' => 1,
			));
        }
    }

    /* -------- code version 2.0 -------- */

    // attributes 

    protected $hidden = ['created_at', 'updated_at'];

    // relationships

    public function products()
    {
        return $this->hasMany('App\Models\Product'); 
    }

    // methods

}