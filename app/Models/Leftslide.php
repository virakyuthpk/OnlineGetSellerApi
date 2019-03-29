<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leftslide extends Model
{
   protected $table = 'leftslides';
    public static function insert($value,$id,$filename){
        $link = $value['link'];
        if($id  == null){
            $left = new Leftslide();
            $left->link = $link;
            $left->image = $filename;
            $left->status = 1;
            $left->save();
        }else{
        	Leftslide::where('id',$id)->update(array(
				'link' 	  =>  $link,
				'image' => $filename,
				'status' => 1,
			));
        }
    }
}
