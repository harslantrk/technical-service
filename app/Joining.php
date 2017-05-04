<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Joining extends Model
{
    protected $table = 'joining';

    protected $fillable = [
        'product_id','twoproduct_id','quantity'
    ];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
