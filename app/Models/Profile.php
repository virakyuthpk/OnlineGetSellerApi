<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DateTime;
use validate;
class Profile extends Model
{
    protected $table = 'profiles';
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public static function insert($value){
    	$phone = $value['phoneNumber'];
        $fname = $value['fname'] ;
        $lname = $value['lname'];
        $address = $value['address'] ;
        $user_id = Auth::user()->id;
        $personaldata = Profile::where('user_id',$user_id)->first();
        $personaldata->user_id = $user_id;
        $personaldata->phone = $phone;
        $personaldata->first_name = $fname;
        $personaldata->last_name = $lname;
       /* $personaldata->email = $email;*/
        $personaldata->address1 = $address;
        $personaldata->save();
    }
}
