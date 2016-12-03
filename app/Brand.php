<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brand';
    protected $fillable = [
        'brand','user_id','status'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
