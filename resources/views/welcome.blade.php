<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Willkommen</title>
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

    <div class="container mt-3">
        <div class="alert alert-warning text-center" role="alert">
            Momentan haben wir Probleme mit der Authentifizierung (dem Anmelden von
            Nutzern). Ich bitte um Verständnis.
            <br>
            Diskussion:
            <a
                href="https://discord.com/channels/133198459531558912/1368155872886259843/threads/1437763182922825738"
                class="alert-link"
                target="_blank"
            >
                CastCrafter Discord
            </a>
        </div>
        <div class="alert alert-info text-center" role="alert">
            Dieses Projekt ist Open Source! Beteilige dich auf GitHub:
            <a
                href="https://github.com/Michaelninder/woistdasdrachenei_de"
                class="alert-link"
                target="_blank"
            >
                GitHub Repository
            </a>
        </div>
        <div class="alert alert-success text-center" role="alert">
            Günstige Domains und Webhosting? Schau bei Skrime vorbei und unterstütze uns!
            <a
                href="https://skrime.eu/a/Michaelninder"
                class="alert-link"
                target="_blank"
            >
                Skrime.eu
            </a>
        </div>
        <div class="alert alert-primary text-center" role="alert">
            Du willst größere Bilder oder Videos bis zu 20MB auf Discord versenden?
            Nutze doch
            <a href="https://dsc.pics" class="alert-link" target="_blank">
                dsc.pics
            </a>
            !  (von mir)
        </div>
    </div>

    <main class="flex-grow-1">
        <div
            class="bg-light d-flex flex-column align-items-center justify-content-center min-vh-100 text-center"
        >
            <img
                src="https://craftattack.one/CA13-LOGO.webp"
                alt="Craft Attack 13 Logo"
                class="mb-4"
                style="max-width: 300px;"
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
                <a
                    href="{{ route('threads.index') }}"
                    class="btn btn-secondary btn-lg"
                >
                    <i class="bi bi-chat-dots-fill me-2"></i> Zum Forum
                </a>
            </div>
            @if (Auth::check())
                <div class="mt-4 text-muted">
                    Angemeldet als: {{ Auth::user()->name }}
                </div>
            @else
                <div class="mt-4 text-muted">Nicht angemeldet.</div>
            @endif
            <div class="mt-2 text-muted">
                Registrierte Benutzer: {{ \App\Models\User::count() }}
            </div>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light text-center">
        <div class="container">
            <span class="text-muted">
                WoIstDasDrachenei.de
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