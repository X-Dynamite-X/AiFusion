<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\APIProvider;
class AiApiProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provider = [
            "aimlapi",
            "huggingface",
        ];

        foreach ($provider as $item) {
        APIProvider::create([
            'name' => $item,
        ]);

    }
    }
}
