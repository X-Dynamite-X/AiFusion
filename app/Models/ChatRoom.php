<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;
    protected $fillable = ['name',"user_id","api_provider_id","ai_model_id"];

    // علاقة غرفة الدردشة بالرسائل
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function apiProvider()
    {
        return $this->belongsTo(APIProvider::class);
    }

    public function aiModel()
    {
        return $this->belongsTo(AIModel::class);
    }

    public function messages()
    {
        return $this->hasMany(AIMessage::class);
    }
}
