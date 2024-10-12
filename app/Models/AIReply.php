<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIReply extends Model
{
    use HasFactory;

    protected $fillable = ['message_id', 'sender_id', 'reply_text'];

    // علاقة الرد بالرسالة الأصلية
    public function aiMessage()
    {
        return $this->belongsTo(AIMessage::class);
    }

    // علاقة الرد بالمستخدم المرسل
    public function aiSender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
