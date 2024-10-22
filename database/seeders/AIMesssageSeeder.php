<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AIMessage;
use App\Models\User;
use App\Models\AIReply;

use App\Models\ChatRoom;


class AIMesssageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        /**
         *     "message_id",
    "sender_id",
    "reply_text",
         */
        $message = AIMessage::create([
            "chat_room_id" => 1,
            "sender_id" => 1,
            "message_text" => "user is " . User::find(1)->name
                . " chat Room  id =1" . ChatRoom::find(1)->name,
        ]);
        AIReply::create([
            "message_id" => $message->id,
            "sender_id" => $message->sender_id,
            'reply_text' => " Bot resbonse "
        ]);
        $message = AIMessage::create([
            "chat_room_id" => 2,
            "sender_id" => 1,
            "message_text" => "user is " . User::find(1)->name . " chat Room  id =2" . ChatRoom::find(2)->name,
        ]);
        AIReply::create([
            "message_id" => $message->id,
            "sender_id" => $message->sender_id,
            'reply_text' => " Bot resbonse "
        ]);
        $message = AIMessage::create([
            "chat_room_id" => 1,
            "sender_id" => 1,
            "message_text" => "user is " . User::find(1)->name
                . " chat Room  id =1" . ChatRoom::find(1)->name,

        ]);
        AIReply::create([
            "message_id" => $message->id,
            "sender_id" => $message->sender_id,
            'reply_text' => " Bot resbonse "
        ]);
        $message = AIMessage::create([
            "chat_room_id" => 2,
            "sender_id" => 1,
            "message_text" => "user is " . User::find(1)->name
                . " chat Room  id =2" . ChatRoom::find(2)->name,

        ]);
        AIReply::create([
            "message_id" => $message->id,
            "sender_id" => $message->sender_id,
            'reply_text' => " Bot resbonse "
        ]);
        $message = AIMessage::create([
            "chat_room_id" => 5,
            "sender_id" => 1,
            "message_text" => "user is " . User::find(1)->name
                . " chat Room  id =5" . ChatRoom::find(5)->name,

        ]);
        AIReply::create([
            "message_id" => $message->id,
            "sender_id" => $message->sender_id,
            'reply_text' => " Bot resbonse "
        ]);
        $message = AIMessage::create([
            "chat_room_id" => 10,
            "sender_id" => 2,
            "message_text" => "user is " . User::find(1)->name
                . " chat Room  id =10" . ChatRoom::find(10)->name,

        ]);
        AIReply::create([
            "message_id" => $message->id,
            "sender_id" => $message->sender_id,
            'reply_text' => " Bot resbonse "
        ]);
        $message = AIMessage::create([
            "chat_room_id" => 5,
            "sender_id" => 9,
            "message_text" => "user is " . User::find(5)->name
                . " chat Room  id =9" . ChatRoom::find(9)->name,

        ]);
        AIReply::create([
            "message_id" => $message->id,
            "sender_id" => $message->sender_id,
            'reply_text' => " Bot resbonse "
        ]);
        $message = AIMessage::create([
            "chat_room_id" => 8,
            "sender_id" => 2,
            "message_text" => "user is " . User::find(2)->name
                . " chat Room  id =8" . ChatRoom::find(8)->name,

        ]);
    }
}
