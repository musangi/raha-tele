<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'matched_user_id',
        'liked'
    ];

    // Relationship: get matched user

    public function matchedUser()
    {
        return $this->belongsTo(User::class, 'matched_user_id');
    }

    public function lastMessage()
    {
        return $this->hasOne(Message::class, 'conversation_id', 'id')->latest();
    }

}
