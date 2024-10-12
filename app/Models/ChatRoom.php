<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;
    protected $fillable = ['room_name'];

    // علاقة غرفة الدردشة بالرسائل
    public function aiMessages()
    {
        return $this->hasMany(AIMessage::class);
    }
}
