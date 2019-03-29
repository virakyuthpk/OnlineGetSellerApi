<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Advertise extends Model
{
    protected $table = 'advertises';

    public static function insert($value,$id,$filename){
        $link = $value['link'];
        $position = $value['position'];
        if($id  == null){
            $ad = new Advertise();
            $ad->link = $link;
            $ad->position = $position;
            $ad->image = $filename;
            $ad->user_id = Auth::user()->id;
            $ad->status = 1;
            $ad->save();
        }else{
            $ad = Advertise::find($id);
            $ad->link = $link;
            $ad->position = $position;
            $ad->image = $filename;
            $ad->user_id = Auth::user()->id;
            $ad->status = 1;
            $ad->save();
            
        /*	Advertise::where('id',$id)->update(array(
				'link' 	  =>  $link,
				'position' =>  $position,
				'image' => $filename,
				'status' => 1,
			));*/
        }
    }
}
