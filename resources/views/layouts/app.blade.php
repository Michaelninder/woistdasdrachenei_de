<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Wo ist das Ei?')</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    >
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/">Wo ist das Ei?</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Navigation umschalten"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">
                            <i class="bi bi-house-door-fill me-1"></i> Startseite
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('threads.index') }}">
                            <i class="bi bi-chat-dots-fill me-1"></i> Forum
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item dropdown">
                            <a
                                class="nav-link dropdown-toggle"
                                href="#"
                                id="navbarDropdown"
                                role="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false"
                            >
                                <i class="bi bi-person-circle me-1"></i>
                                Willkommen, {{ Auth::user()->name }}
                            </a>
                            <ul
                                class="dropdown-menu dropdown-menu-end"
                                aria-labelledby="navbarDropdown"
                            >
                                <li>
                                    <a class="dropdown-item" href="/logout">
                                        <i class="bi bi-box-arrow-right me-1"></i> Abmelden
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a
                                class="btn btn-outline-primary me-2"
                                href="{{ route('auth.twitch.redirect') }}"
                            >
                                <i class="bi bi-twitch me-1"></i> Twitch Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                class="btn btn-outline-info text-dark"
                                href="{{ route('auth.discord.redirect') }}"
                            >
                                <i class="bi bi-discord me-1"></i> Discord Login
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="container my-4 flex-grow-1">
        @yield('content')
    </main>

    <footer class="footer mt-auto py-3 bg-light text-center">
        <div class="container">
            <span class="text-muted">
                &copy; {{ date('Y') }} WoIstDasDrachenei.de
            </span>
            <span class="text-muted mx-2">|</span>
            <a href="https://fternis.de/imprint" class="text-decoration-none">
                Impressum (Fabian Ternis)
            </a>
            Alias: Michaelninder
        </div>
    </footer>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"
    ></script>
</body>
</html>