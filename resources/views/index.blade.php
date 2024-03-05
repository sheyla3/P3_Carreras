<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Caballos</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="app.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body>
        <h1>Home</h1>
        <a class="linkAdminLogin" href="{{ route('loginAdmin') }}"> Panel Administrador</a>
        @include('pie')
    </body>
</html>
