<?php

use App\Models\ChatRoom;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AI\AIMessageController;
use App\Http\Controllers\Socialite\AuthController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix("{provider}")->name("provider.")->controller(AuthController::class)->group(function () {
    Route::get('/login', 'redirectToProvider')->name('login');
    Route::get('/callback', 'handleProviderCallback')->name('callback');
});
//

Route::get("getAllRooms", [AIMessageController::class, "getAllRooms"]);
Route::get('/providers-with-models', [AIMessageController::class, 'getAllProvidersWithModels']);

Route::prefix("{apiProviderName}")
    ->name("AiProvider.AiModel.")
    ->controller(AIMessageController::class)
    ->group(function () {
        // meta-llama/Llama-3.2-11B-Vision-Instruct
        Route::post("/createRooms", "createChatRoom");
        Route::get("/getChatInRoom/{room}", "getTextChat");
        Route::post('/generate-text/{room}', 'generateText');
    });
