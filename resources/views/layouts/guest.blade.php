<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">
        @vite('resources/scss/styles.scss')
        @stack('login-css')
        <title>Login | StockPRO</title>
    </head>
    <body>
        @yield('content')
        <!-- Realizando import do Bootstrap -->
        @vite('resources/js/main.js')
    </body>
</html>
