@extends('layouts.app')

@section('title', 'Willkommen')

@section('content')
    <div
        class="bg-light d-flex flex-column align-items-center justify-content-center min-vh-100 text-center"
    >
        <h1 class="display-4 mb-4">Wo ist das Ei?</h1>
        <p class="lead mb-5">
            Melde dich an, um an den Diskussionen teilzuhaben oder schau ins Forum!
        </p>
        <div class="d-grid gap-3 col-md-6 mx-auto">
            @guest
                <a
                    href="{{ route('auth.twitch.redirect') }}"
                    class="btn btn-primary btn-lg"
                >
                    <i class="bi bi-twitch me-2"></i> Mit Twitch anmelden
                </a>
                <a
                    href="{{ route('auth.discord.redirect') }}"
                    class="btn btn-info btn-lg text-white"
                >
                    <i class="bi bi-discord me-2"></i> Mit Discord anmelden
                </a>
            @endguest
            <a href="{{ route('threads.index') }}" class="btn btn-secondary btn-lg">
                <i class="bi bi-chat-dots-fill me-2"></i> Zum Forum
            </a>
        </div>
    </div>
@endsection