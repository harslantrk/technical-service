<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'product_id','customer_id','user_id','quantity','price','detail','status'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
