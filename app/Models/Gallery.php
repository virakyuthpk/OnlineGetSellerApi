<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use File;
class Gallery extends Model
{
    protected $table = 'galleries';

    public static function uploadFile($destination,$image,$temperature)
    {
        if($image != null){
            $logoPath = public_path('uploads').$destination;
            $logoName = /*$image->getClientOriginalName();*/ 'img-'.time().'.'.$image->getClientOriginalExtension();
            if($image->move($logoPath, $logoName)){
                $logo_url = Request::root().'/public/uploads'.$destination.'/'.$logoName;
            }
            if($temperature != ''){
                $filename = public_path().'/uploads'.$destination.'/'.$temperature;
                File::delete($filename);
                //unlink(public_path().'/uploads'.$destination.'/'.$temperature);
            }
        }else{
            $logoName= $temperature;
        }
        return $logoName;
    }
}
