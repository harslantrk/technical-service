<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $table="service";
    protected $fillable = [
    	'customer_id', 'product_id','user_id','customer_fault','process','process_proposal','deposit','warranty','status','service_detail'
    ];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
