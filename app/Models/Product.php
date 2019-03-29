<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'id','pcode', 'category_id', 'parent_category', 'user_id', 'sub_id', 'braind_id', 'supplier_id', 'unit_id', 'name_en', 'name_kh','detail_en','detail_kh','des_en','des_kh','sell_price','model','special','image','max_order','status'
    ];
}
