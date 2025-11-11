<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Api\ThreadController as ApiThreadController;
use App\Http\Controllers\Api\ThreadMessageController as ApiThreadMessageController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ThreadMessageController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('welcome');
});

Route::get('/auth/twitch/redirect', [SocialiteController::class, 'redirectToTwitch'])->name('auth.twitch.redirect');
Route::get('/auth/twitch/callback', [SocialiteController::class, 'handleTwitchCallback']);

Route::get('/auth/discord/redirect', [SocialiteController::class, 'redirectToDiscord'])->name('auth.discord.redirect');
Route::get('/auth/discord/callback', [SocialiteController::class, 'handleDiscordCallback']);

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/login', function () {
    return redirect('/');
})->name('login');

// Web Routes for Forum Functionality
Route::resource('threads', ThreadController::class);
Route::resource('threads.messages', ThreadMessageController::class);

// API Routes for Forum Functionality
Route::prefix('api1')->group(function () {
    Route::resource('threads', ApiThreadController::class);
    Route::resource('threads.messages', ApiThreadMessageController::class);
});
