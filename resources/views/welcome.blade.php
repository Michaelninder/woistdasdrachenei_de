<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wo ist das Ei?</title>
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
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container text-center">
        <h1 class="display-4 mb-4">Wo ist das Ei?</h1>
        <p class="lead mb-5">
            Melde dich and um an den Diskussionen teil zu haben.
        </p>
        <div class="d-grid gap-3 col-md-6 mx-auto">
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
        </div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"
    ></script>
</body>
</html>