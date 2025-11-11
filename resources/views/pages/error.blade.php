<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fehler {{ $error_code ?? 'Unbekannt' }}</title>
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
        <h1 class="display-1 fw-bold text-danger">
            {{ $error_code ?? 'Fehler' }}
        </h1>
        <p class="fs-3">
            <span class="text-danger">Upps!</span> Etwas ist schiefgelaufen.
        </p>
        <p class="lead">
            Die Seite, die Sie suchen, ist möglicherweise nicht verfügbar,
            existiert nicht oder ein anderer Fehler ist aufgetreten.
        </p>
        <a href="/" class="btn btn-primary btn-lg mt-4">
            <i class="bi bi-house-door-fill me-2"></i> Zur Startseite
        </a>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"
    ></script>
</body>
</html>