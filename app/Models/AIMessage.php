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
        return $this->belongsTo(related: ChatRoom::class);
    }

    // علاقة الرسالة بالمستخدم المرسل
    public function aiSender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    // علاقة الرسالة بالردود
    public function aiReplies()
    {
        return $this->hasMany(AIReply::class);
    }
}
