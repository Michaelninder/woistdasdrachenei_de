<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SocialiteController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/twitch/redirect', [SocialiteController::class, 'redirectToTwitch'])->name('auth.twitch.redirect');
Route::get('/auth/twitch/callback', [SocialiteController::class, 'handleTwitchCallback']);

Route::get('/auth/discord/redirect', [SocialiteController::class, 'redirectToDiscord'])->name('auth.discord.redirect');
Route::get('/auth/discord/callback', [SocialiteController::class, 'handleDiscordCallback']);
