<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error {{ $error_code }}</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f8f8f8;
            color: #333;
        }
        .error-container {
            text-align: center;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 4em;
            margin-bottom: 0.2em;
            color: #e74c3c;
        }
        p {
            font-size: 1.2em;
        }
        a {
            color: #3498db;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>{{ $error_code }}</h1>
        <p>Oops! Something went wrong.</p>
        <p>We are sorry, but an error occurred.</p>
        <a href="/">Go to Homepage</a>
    </div>
</body>
</html>
