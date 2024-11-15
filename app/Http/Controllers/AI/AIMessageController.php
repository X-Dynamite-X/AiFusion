<?php

namespace App\Http\Controllers\AI;

use App\Models\User;

use GuzzleHttp\Client;
use App\Models\AIModel;
use App\Models\AIReply;
use App\Models\ChatRoom;
use App\Models\AIMessage;
use App\Models\APIProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use GuzzleHttp\Exception\RequestException;

class AIMessageController extends Controller
{

    /**
     * "Invalid discriminator value. Expected 'codellama/CodeLlama-34b-Instruct-hf' | 'upstage/SOLAR-10.7B-Instruct-v1.0' |
     * 'meta-llama/Meta-Llama-Guard-3-8B' | 'NousResearch/Nous-Hermes-2-Yi-34B' | 'togethercomputer/Llama-3-8b-chat-hf-int4' |
     * 'togethercomputer/StripedHyena-Nous-7B' | 'google/gemma-2b-it' | 'Gryphe/MythoMax-L2-13b' | 'meta-llama/LlamaGuard-2-8b' |
     * 'mistralai/Mistral-7B-Instruct-v0.1' | 'mistralai/Mistral-7B-Instruct-v0.2' | 'meta-llama/Llama-Vision-Free' |
     * 'meta-llama/Llama-3.2-11B-Vision-Instruct-Turbo' | 'meta-llama/Llama-Guard-3-11B-Vision-Turbo' | 'Qwen/Qwen2-72B-Instruct'
     * | 'Qwen/Qwen1.5-72B-Chat' | 'deepseek-ai/deepseek-llm-67b-chat' | 'togethercomputer/Llama-3-8b-chat-hf-int8' | 'mistralai/Mistral-7B-Instruct-v0.3'
     *  | 'Qwen/Qwen1.5-110B-Chat' | 'meta-llama/Llama-2-13b-chat-hf' | 'google/gemma-2-27b-it' | 'meta-llama/Meta-Llama-3-70B-Instruct-Turbo'
     * | 'meta-llama/Meta-Llama-3-70B-Instruct-Lite' | 'google/gemma-2-9b-it' | 'meta-llama/Llama-3-8b-chat-hf' | 'meta-llama/Meta-Llama-3.1-70B-Instruct-Turbo'
     *  | 'microsoft/WizardLM-2-8x22B' | 'mistralai/Mixtral-8x7B-Instruct-v0.1' | 'meta-llama/Llama-3-70b-chat-hf' | 'llava-hf/llava-v1.6-mistral-7b-hf' |
     *  'databricks/dbrx-instruct' | 'NousResearch/Nous-Hermes-2-Mixtral-8x7B-DPO' | 'meta-llama/Meta-Llama-3-8B-Instruct-Turbo' | 'meta-llama/Meta-Llama-3-8B-Instruct-Lite'
     *  | 'Meta-Llama/Llama-Guard-7b' | 'meta-llama/Meta-Llama-3.1-405B-Instruct-Turbo' | 'meta-llama/Meta-Llama-3.1-8B-Instruct-Turbo' |
     *  'mistralai/Mixtral-8x22B-Instruct-v0.1' | 'Gryphe/MythoMax-L2-13b-Lite' | 'meta-llama/Llama-3.2-90B-Vision-Instruct-Turbo' |
     * 'NousResearch/Hermes-3-Llama-3.1-405B-Turbo' | 'meta-llama/Llama-2-7b-chat-hf' | 'meta-llama/Llama-3.2-3B-Instruct-Turbo' |
     * 'WizardLM/WizardLM-13B-V1.2' | 'togethercomputer/Koala-7B' | 'Qwen/Qwen2-1.5B-Instruct' | 'teknium/OpenHermes-2-Mistral-7B' |
     *  'Qwen/Qwen2-7B-Instruct' | 'togethercomputer/guanaco-65b' | 'Undi95/ReMM-SLERP-L2-13B' | 'lmsys/vicuna-7b-v1.3' | 'Undi95/Toppy-M-7B' |
     * 'Phind/Phind-CodeLlama-34B-v2' | 'Phind/Phind-CodeLlama-34B-Python-v1' | 'NumbersStation/nsql-llama-2-7B' | 'NousResearch/Nous-Hermes-Llama2-70b' |
     *  'lmsys/vicuna-13b-v1.5-16k' | 'openchat/openchat-3.5-1210' | 'Austism/chronos-hermes-13b' | 'snorkelai/Snorkel-Mistral-PairRM-DPO' | 'Qwen/Qwen1.5-14B-Chat' |
     *  'Qwen/Qwen1.5-1.8B-Chat' | 'Snowflake/snowflake-arctic-instruct' | 'NousResearch/Nous-Hermes-2-Mixtral-8x7B-SFT' | 'deepseek-ai/deepseek-coder-33b-instruct' |
     * 'togethercomputer/CodeLlama-7b-Instruct' | 'codellama/CodeLlama-34b-Python-hf' | 'NousResearch/Nous-Hermes-Llama2-13b' | 'lmsys/vicuna-13b-v1.5' |
     * 'togethercomputer/guanaco-13b' | 'codellama/CodeLlama-70b-Python-hf' | 'togethercomputer/CodeLlama-34b-Python' | 'togethercomputer/CodeLlama-34b-Instruct'
     *  | 'togethercomputer/CodeLlama-34b' | 'codellama/CodeLlama-13b-hf' | 'codellama/CodeLlama-13b-Instruct-hf' | 'togethercomputer/CodeLlama-13b-Instruct' |
     *  'togethercomputer/llama-2-13b-chat' | 'lmsys/vicuna-13b-v1.3' | 'WizardLM/WizardCoder-Python-34B-V1.0' | 'NousResearch/Nous-Hermes-2-Mistral-7B-DPO' |
     * 'togethercomputer/alpaca-7b' | 'garage-bAInd/Platypus2-70B-instruct' | 'google/gemma-7b-it' | 'allenai/OLMo-7B-Instruct' | 'togethercomputer/guanaco-33b' |
     *  'togethercomputer/Koala-13B' | 'togethercomputer/llama-2-7b-chat' | 'togethercomputer/SOLAR-10.7B-Instruct-v1.0-int4' | 'togethercomputer/guanaco-7b' |
     * 'Open-Orca/Mistral-7B-OpenOrca' | 'NousResearch/Nous-Hermes-llama-2-7b' | 'Qwen/Qwen1.5-32B-Chat' | 'NousResearch/Nous-Capybara-7B-V1p9' |
     *  'meta-llama/Meta-Llama-3-8B-Instruct' | 'lmsys/vicuna-7b-v1.5' | 'codellama/CodeLlama-34b-hf' | 'zero-one-ai/Yi-34B-Chat' | 'meta-llama/Meta-Llama-3-70B-Instruct'
     *  | 'togethercomputer/CodeLlama-7b-Python' | 'codellama/CodeLlama-70b-hf' | 'codellama/CodeLlama-70b-Instruct-hf' | 'Qwen/Qwen1.5-7B-Chat' |
     *  'cognitivecomputations/dolphin-2.5-mixtral-8x7b' | 'togethercomputer/CodeLlama-13b-Python' | 'codellama/CodeLlama-7b-hf' | 'togethercomputer/llama-2-70b-chat' |
     *  'codellama/CodeLlama-13b-Python-hf' | 'Qwen/Qwen1.5-0.5B-Chat' | 'codellama/CodeLlama-7b-Instruct-hf' | 'teknium/OpenHermes-2p5-Mistral-7B' | 'Qwen/Qwen1.5-4B-Chat' |
     *  'meta-llama/Llama-2-70b-chat-hf' | 'codellama/CodeLlama-7b-Python-hf' | 'carson/ml318br' | 'meta-llama/Meta-Llama-3.1-70B-Instruct-Reference' |
     *  'claude-3-opus-20240229' | 'claude-3-sonnet-20240229' | 'claude-3-haiku-20240307' | 'claude-3-5-sonnet-20240620'  | 'gpt-4o-2024-08-06' |
     * |  | | 'chatgpt-4o-latest' | '' | ''
     *  | 'gpt-4-0125-preview'
     * 'gpt-3.5-turbo-1106' |  | 'gpt-3.5-turbo-16k-0613' | 'gpt-3.5-turbo-0301' | 'o1-preview' | 'o1-preview-2024-09-12' | 'o1-mini'
     * | 'o1-mini-2024-09-12' | 'gemini-1.5-flash' | 'gemini-1.5-pro' | 'gemini-pro' | 'anthropic/claude-3-opus' | 'anthropic/claude-3-sonnet' |
     * 'anthropic/claude-3-haiku' | 'anthropic/claude-3.5-sonnet'"
     */
// AIProviderController.php
public function getAllProvidersWithModels()
    {
        $providers = APIProvider::with(
            ['aiModels' => function ($query) {
            $query->with('chatRooms'); // تحميل الغرف الخاصة بكل نموذج
            }])->get();
        return response()->json($providers);
    }
    public function createChatRoom($apiProviderName, Request $request)
    {
        $userId = Auth::id();
        $aiModelName = $request->aiModelName;
        // dd($request->aiModelName);
        $userId = 1;


        // البحث عن مزود الخدمة والنموذج بناءً على الأسماء
        $apiProvider = APIProvider::where('name', $apiProviderName)->firstOrFail();
        $aiModel = AIModel::where('name',"=", $aiModelName)->where('api_provider_id', $apiProvider->id)->firstOrFail();

        // إنشاء غرفة دردشة جديدة مرتبطة بالمستخدم الحالي، مزود الخدمة، ونموذج الذكاء الاصطناعي
        $newRoom = ChatRoom::create([
            "name" => Date::now(),
            "user_id" => $userId,
            "api_provider_id" => $apiProvider->id,
            "ai_model_id" => $aiModel->id,
        ]);

        return $this->generateText($apiProviderName, $newRoom,$request);
    }

    public function generateText($apiProviderName, ChatRoom $room , Request $request)
    {
        if ($apiProviderName === "aimlapi") {
            return $this->createChatRoom_aimlapi($request, $room);
        } elseif ($apiProviderName === "huggingface") {
            return $this->createChatRoom_huggingface($request, $room);
        }
    }

    // إعداد غرفة دردشة جديدة لـ API "aimlapi"
    public function createChatRoom_aimlapi(Request $request, ChatRoom $room)
    {
        $apiKey = env('AI_ML_API_KEY');
        $postUrlAi = "https://api.aimlapi.com/chat/completions";
        $aiModel = "gpt-4-turbo";

        if (!$apiKey) {
            return response()->json(['error' => 'API key is missing'], 500);
        }

        $prompt = trim($request->input('prompt'));
        if (!$prompt) {
            return response()->json(['error' => 'Prompt is required'], 400);
        }

        try {
            $client = new Client();
            $response = $client->post($postUrlAi, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "model" => $aiModel,
                    "messages" => [
                        [
                            "role" => "user",
                            "content" => $prompt
                        ]
                    ]
                ]
            ]);

            $body = json_decode($response->getBody(), true);
            $botReplyText = $body['choices'][0]['message']['content'] ?? 'No content returned from API';

            // إنشاء رسالة المستخدم وحفظ الرد
            $userMessage = AIMessage::create([
                "chat_room_id" => $room->id,
                // "sender_id" => Auth::id(),
                "sender_id" => 1,
                "message_text" => $prompt,
            ]);

            $aiReply = AIReply::create([
                "message_id" => $userMessage->id,
                "ai_model_id" => $room->ai_model_id,
                "reply_text" => $botReplyText,
            ]);

            return response()->json([
                "userMessage" => $userMessage,
                'reply' => $aiReply,
                'room' => $room,
            ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $responseBody = json_decode($e->getResponse()->getBody(), true);
                return response()->json(['error' => $responseBody], $e->getResponse()->getStatusCode());
            } else {
                return response()->json(['error' => 'API request failed'], 500);
            }
        }
    }

    // إعداد غرفة دردشة جديدة لـ API "huggingface"
    public function createChatRoom_huggingface(Request $request, ChatRoom $room)
    {
        $apiKey = env('HUGGINGFACE_API_KEY');
        $aiModel = $request->aiModelName;
        $postUrlAi = "https://api-inference.huggingface.co/models/".$aiModel;
        // dd($postUrlAi);
        if (!$apiKey) {
            return response()->json(['error' => 'API key is missing'], 500);
        }

        $prompt = trim($request->input('prompt'));
        if (!$prompt) {
            return response()->json(['error' => 'Prompt is required'], 400);
        }

        try {
            $client = new Client();
            $response = $client->post($postUrlAi, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    "inputs"=>$prompt,
                ]
            ]);
            $body = json_decode($response->getBody(), true);
            $botReplyText = $body[0]['generated_text'] ?? 'No content returned from API';
            $userMessage = AIMessage::create([
                "chat_room_id" => $room->id,
                "sender_id" => 1,
                "message_text" => $prompt,
            ]);

            $aiReply = AIReply::create([
                "message_id" => $userMessage->id,
                "ai_model_id" => $room->ai_model_id,
                "reply_text" => $botReplyText,
            ]);

            return response()->json([
                "userMessage" => $userMessage,
                'reply' => $aiReply,
                'room' => $room,
            ]);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $responseBody = json_decode($e->getResponse()->getBody(), true);
                return response()->json(['error' => $responseBody], $e->getResponse()->getStatusCode());
            } else {
                return response()->json(['error' => 'API request failed'], 500);
            }
        }
    }

    // جلب جميع الرسائل الخاصة بغرفة دردشة معينة
    public function getTextChat($apiProviderName, ChatRoom $room)
    {
        $textMessages = AIMessage::where("chat_room_id", $room->id)
            ->with("replies")
            ->get();

        return response()->json($textMessages);
    }
}
