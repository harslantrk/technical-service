<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'support';
    protected $fillable = [
        'sender_id','receiver_id','title','detail','status','read','trash'
    ];
}
