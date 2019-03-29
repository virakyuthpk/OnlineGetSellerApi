<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id', 'qty', 'product_id', 'dis_price', 'variant_id', 'province_id', 'subtotal', 'district_id', 'des', 'amout', 'f_name', 'l_name', 'email', 'phone', 'address'
    ];

}
