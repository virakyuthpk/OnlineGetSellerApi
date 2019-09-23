<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendors extends Model
{
    protected $table = 'vendors';
    protected $fillable = [
        'id','user_id', 'shop_name', 'province_id', 'disctrict_id', 'commune_id', 'detail', 'pic', 'idcard', 'store_url', 'status', 'email', 'phone', 'address'
    ];
}
