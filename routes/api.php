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
Route::prefix("{provider}")->name("provider.")->controller(AuthController::class)->group(function(){
    Route::get('/login', 'redirectToProvider')->name('login');
    Route::get('/callback', 'handleProviderCallback')->name('callback');
});
//
Route::post('/generate-text/{room}', action: [AIMessageController::class, 'generateText']);
Route::get("getAllRooms",[AIMessageController::class,"getAllRooms"],);
Route::get("getChatInRoom/{room}",[AIMessageController::class,"getTextChat"],);


// test
Route::get("getAllRooms_test",[AIMessageController::class,"getAllRooms_test"],);
