<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
    protected $table = 'logos';
    public static function insert($id,$filename){
        if($id  == null){
            $lo = new Logo();
            $lo->image = $filename;
            $lo->save();
        }else{
        	Logo::where('id',$id)->update(array(
				'image' => $filename,
			));
        }
    }
}
