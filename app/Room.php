<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'owner');
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'rooms_users', 'room_id');
    }

    public function invites()
    {
        return $this->belongsToMany(User::class, 'invites', 'room_id', 'user_id');
    }
}
