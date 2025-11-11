<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Wo ist das Drachenei?')</title>
</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a>
            <a href="/threads">Forum</a>
            @auth
                <span>Welcome, {{ Auth::user()->name }}</span>
                <a href="/logout">Logout</a>
            @else
                <a href="/auth/twitch/redirect">Login with Twitch</a>
                <a href="/auth/discord/redirect">Login with Discord</a>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Wo ist das Drachenei?</p>
    </footer>
</body>
</html>
