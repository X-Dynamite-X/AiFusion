<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIMessage extends Model
{
    use HasFactory;

    protected $fillable = ['chat_room_id', 'sender_id', 'message_text'];

    // علاقة الرسالة بغرفة الدردشة
    public function chatRoom()
    {
        return $this->belongsTo(ChatRoom::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function replies()
    {
        return $this->hasMany(AIReply::class, 'message_id');
    }
    // علاقة الرسالة بالردود

}
