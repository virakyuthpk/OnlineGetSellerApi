<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $table = 'campaigns';
    public static function insert($value,$id){
        if($id ==  null){
            $cam = new Campaign();
            $cam->start_date = $value['start_date'];
            $cam->end_date = $value['end_date'];
            $cam->category_id = $value['category_id'];
            $cam->discount_id = $value['discount_id'];
            $cam->status = '1';
            $cam->save();
        }else{
            $cam = Campaign::find($id);
            $cam->start_date = $value['start_date'];
            $cam->end_date = $value['end_date'];
            $cam->category_id = $value['category_id'];
            $cam->discount_id = $value['discount_id'];
            $cam->status = '1';
            $cam->save();
        }
    }
}
