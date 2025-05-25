<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;700&display=swap" rel="stylesheet">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        @vite('resources/scss/styles.scss')
        @stack('login-css')
        @stack('register-css')
        @stack('forgot_password-css')
        <title>@yield('title')</title>
    </head>
    <body>
        @yield('content')
        <!-- Realizando import do Bootstrap -->
        @vite('resources/js/main.js')
    </body>
</html>
