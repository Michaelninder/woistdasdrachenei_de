<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\SocialAccount;
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
            $socialiteUser = Socialite::driver('twitch')->user();

            $socialAccount = SocialAccount::where('provider_name', 'twitch')
                ->where('provider_id', $socialiteUser->getId())
                ->first();

            if ($socialAccount) {
                Auth::login($socialAccount->user);
                return redirect('/threads');
            } else {
                $user = User::where('email', $socialiteUser->getEmail())->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $socialiteUser->getName(),
                        'email' => $socialiteUser->getEmail(),
                        'role' => UserRole::User,
                    ]);
                }

                $user->socialAccounts()->create([
                    'provider_name' => 'twitch',
                    'provider_id' => $socialiteUser->getId(),
                    'access_token' => $socialiteUser->token,
                    'refresh_token' => $socialiteUser->refreshToken,
                ]);

                Auth::login($user);
                return redirect('/dashboard');
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Twitch authentication failed: ' . $e->getMessage());
        }
    }

    public function redirectToDiscord()
    {
        return Socialite::driver('discord')->setScopes(['identify', 'email'])->redirect();
    }

    public function handleDiscordCallback()
    {
        try {
            $socialiteUser = Socialite::driver('discord')->user();

            $socialAccount = SocialAccount::where('provider_name', 'discord')
                ->where('provider_id', $socialiteUser->getId())
                ->first();

            if ($socialAccount) {
                Auth::login($socialAccount->user);
                return redirect('/dashboard');
            } else {
                $user = User::where('email', $socialiteUser->getEmail())->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $socialiteUser->getName(),
                        'email' => $socialiteUser->getEmail(),
                        'role' => UserRole::User,
                    ]);
                }

                $user->socialAccounts()->create([
                    'provider_name' => 'discord',
                    'provider_id' => $socialiteUser->getId(),
                    'access_token' => $socialiteUser->token,
                    'refresh_token' => $socialiteUser->refreshToken,
                ]);

                Auth::login($user);
                return redirect('/threads');
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Discord authentication failed: ' . $e->getMessage());
        }
    }
}
