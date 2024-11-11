<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiModel extends Model
{
    use HasFactory;
    protected $fillable = ['name',
    "api_provider_id"
    ];

    public function apiProvider()
    {
        return $this->belongsTo(APIProvider::class);
    }

    public function chatRooms()
    {
        return $this->hasMany(ChatRoom::class);
    }

    public function replies()
    {
        return $this->hasMany(AIReply::class);
    }

}
