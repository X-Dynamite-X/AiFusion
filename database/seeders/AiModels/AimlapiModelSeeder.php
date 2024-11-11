<?php

namespace Database\Seeders\AiModels;

use App\Models\AiModel;
use App\Models\APIProvider;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AimlapiModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $models = ["gpt-4-turbo",""];
        $api_provider = ApiProvider::where("name","=","aimlapi")->first();
        // dd($api_provider->id);
        // $api_provider = APIProvider::where("name", "=", "aimlapi")->first();

        if ($api_provider) {
            foreach ($models as $item) {
                if ($item !== "") {
                    AiModel::create([
                        'name' => $item,
                        'api_provider_id' => $api_provider->id
                    ]);
                }
            }
        } else {
            echo "API provider not found.";
        }
    }
}
