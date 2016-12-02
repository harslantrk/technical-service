<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDelegation extends Model
{
   
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="delegation";
    protected $fillable = [
        'id','name', 'auth','status',
    ];

}
