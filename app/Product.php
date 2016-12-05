<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Ürünler
    protected $table = 'product';
    protected $fillable = [
    	'name','brand_id','product_type_id','user_id','detail','image','stock','in_price','out_price','status'
    ];

    public function brand (){
        return $this->belongsTo('App\Brand');
    }
    public function product_type (){
        return $this->belongsTo('App\Product_Type');
    }
    public function user (){
        return $this->belongsTo('App\User');
    }
}
