<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /* The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role','social_id','phone'
    ];

    /* The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /* -------- Code version 2.0 -------- */ 

    // attributes

    // protected $hidden = ['created_at', 'updated_at'];


    //  relationships 

    protected function products()
    {
        return $this->hasMany('App\Models\Product');
    }

    // public function 
    

    //  methods 


}