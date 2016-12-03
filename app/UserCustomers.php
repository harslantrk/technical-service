<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCustomers extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table="customers";
    protected $fillable = [
        'name', 'surname','email','phone','gsm','adres','companyName','status'
    ];
}
