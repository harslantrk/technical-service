<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';

    protected $fillable = [
        'user_id','title','start_time','end_time'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
