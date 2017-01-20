<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServicePayment extends Model
{
    protected $table = 'service_payment';
    protected $fillable = [
        'user_id','product_id','service_id','quantity','total','kdv','detail'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function service(){
        return $this->belongsTo('App\Service');
    }
}
