<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['text', 'user_id', 'room_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
