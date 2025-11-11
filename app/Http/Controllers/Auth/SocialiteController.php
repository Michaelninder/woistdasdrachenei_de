<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserRole;

class SocialiteController extends Controller
{
    public function redirectToTwitch()
    {
        return Socialite::driver('twitch')->redirect();
    }

    public function handleTwitchCallback()
    {
        try {
            $twitchUser = Socialite::driver('twitch')->user();

            $user = User::updateOrCreate(
                ['email' => $twitchUser->getEmail()],
                [
                    'name' => $twitchUser->getName(),
                    'role' => UserRole::User, // Default role for new users
                ]
            );

            Auth::login($user);

            return redirect('/dashboard'); // Redirect to a dashboard or home page
        } catch (\Exception $e) {
            // Handle error, e.g., log it and redirect to an error page
            return redirect('/login')->with('error', 'Twitch authentication failed.');
        }
    }

    public function redirectToDiscord()
    {
        return Socialite::driver('discord')->setScopes(['identify', 'email'])->redirect();
    }

    public function handleDiscordCallback()
    {
        try {
            $discordUser = Socialite::driver('discord')->user();

            $user = User::updateOrCreate(
                ['email' => $discordUser->getEmail()],
                [
                    'name' => $discordUser->getName(),
                    'role' => UserRole::User, // Default role for new users
                ]
            );

            Auth::login($user);

            return redirect('/dashboard'); // Redirect to a dashboard or home page
        } catch (\Exception $e) {
            // Handle error, e.g., log it and redirect to an error page
            return redirect('/login')->with('error', 'Discord authentication failed.');
        }
    }
}
