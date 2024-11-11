<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiProvider extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function aiModels()
    {
        return $this->hasMany(AIModel::class);
    }

    public function chatRooms()
    {
        return $this->hasMany(ChatRoom::class);
    }
}
