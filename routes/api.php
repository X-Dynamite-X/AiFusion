<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Socialite\AuthController;
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix("{provider}")->name("provider.")->controller(AuthController::class)->group(function(){
    Route::get('/login', 'redirectToProvider')->name('login');
    Route::get('/callback', 'handleProviderCallback')->name('callback');
});
//
