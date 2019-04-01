<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'id','pcode', 'category_id', 'parent_category', 'user_id', 'sub_id', 'braind_id', 'supplier_id', 'unit_id', 'name_en', 'name_kh','detail_en','detail_kh','des_en','des_kh','sell_price','model','special','image','max_order','status'
    ];

    /* -------- code version v2.0 -------- */

    // attributes

    protected $hidden = ['created_at', 'updated_at'];


    //  relationships 

    protected function user()
    {
        return $this->belongsTo('App\User');
    }
    protected function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }
    protected function unit()   
    {
        return $this->belongsTo('App\Models\Unit');
    }
    protected function brand()   
    {
        return $this->belongsTo('App\Models\Brand', 'braind_id');
    }

    //  methods 

    public function statusAndOrder()
    {
        return $this->where('status', 1)->orderBy('created_at', 'desc');
    }
    public function statusAndOrderWithPaginate($skip = 0)
    {
        return $this->where('status', 1)->orderBy('created_at', 'desc')->take(10)->skip($skip);
    }
}