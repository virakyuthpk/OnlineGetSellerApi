<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    public static function insert($value,$id,$filename){
        $website = $value['website'];
        $name_en = $value['name_en'];
        $name_kh = $value['name_kh'];
        if($id  == null){
            $bra = new Brand();
            $bra->website = $website;
            $bra->name_en = $name_en;
            $bra->name_kh = $name_kh;
            $bra->image = $filename;
            $bra->status = 1;
            $bra->save();
        }else{
        	Brand::where('id',$id)->update(array(
				'website' 	  =>  $website,
				'name_en' =>  $name_en,
				'name_kh'	=> $name_kh,
				'image' => $filename,
				'status' => 1,
			));
        }
    }
    // version 2 code 
    public $hidden = ['created_at', 'updated_at']; 
}