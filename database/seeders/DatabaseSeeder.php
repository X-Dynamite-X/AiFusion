<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'dynamite',
            'email' => 'dynamite@gmail.com',
            'password' => bcrypt(value: '123'),
        ]);
        User::factory(count: 10)->create();

            $this->call([
                ChatRoomSeeder::class,
                AIMesssageSeeder::class,
            ]);
    }
}
