<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ChatRoom;
class ChatRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i=1 ; $i<11;$i++ ){

            ChatRoom::create(["name"=>"test_".$i]);
        }
    }
}
