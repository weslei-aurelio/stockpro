<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/scss/styles.scss')
        <title>StockPRO</title>
    </head>
    <body>

        @include('layouts.components.header')
        @yield('content')
        @include('layouts.components.footer')
        <!-- Realizando import do Bootstrap -->
        @vite('resources/js/main.js')
    </body>
</html>
