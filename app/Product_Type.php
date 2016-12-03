<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Type extends Model
{
    protected $table = 'product_type';
    protected $fillable = [
        'product_type','user_id','status'
    ];
}
