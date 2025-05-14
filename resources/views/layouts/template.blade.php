<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Realizando import do Bootstrap -->
    @vite('resources/js/app.js')

    <title>StockPRO</title>
</head>
<body>
    @include('layouts.components.header')
    @yield('content')
    @include('layouts.components.footer')
</body>
</html>
