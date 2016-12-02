<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	protected $table="services";
     protected $fillabled = [
    	'title', 'description','content','image','keywords','slug','short_content','icons','priority','status',
    ];
}
