<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AIReply extends Model
{
    use HasFactory;
    protected $fillable = [
    "message_id",
    "ai_model_id",
    "reply_text",
    ];

    public function message()
    {
        return $this->belongsTo(AIMessage::class);
    }

    public function aiModel()
    {
        return $this->belongsTo(AIModel::class);
    }


}
