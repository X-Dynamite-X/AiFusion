<?php

namespace Database\Seeders\AiModels;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AiModel;
use App\Models\APIProvider;


class HuggingfaceModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $models = [
            "meta-llama/Llama-3.2-11B-Vision-Instruct",
            "openai-community/gpt2",
            "HuggingFaceTB/SmolLM2-1.7B-Instruct",
            "meta-llama/Llama-3.2-3B-Instruct",
            "meta-llama/Llama-3.2-1B",
            "HuggingFaceTB/SmolLM2-360M-Instruct",
            "meta-llama/Llama-3.2-1B-Instruct",
            "Qwen/Qwen2.5-72B-Instruct",
            "meta-llama/Meta-Llama-3-8B-Instruct",
            "meta-llama/Llama-3.2-3B",
            "microsoft/Phi-3.5-mini-instruct",
            "mistralai/Mistral-7B-Instruct-v0.3",
            "google/gemma-2-9b-it"
        ];
        $api_provider = ApiProvider::where("name","=","huggingface")->first();

        foreach ($models as $item){
            if($item !==""){

            AiModel::create([
                'name' => $item,
                'api_provider_id'=>$api_provider->id
            ]);
        }
        }

    }
}
