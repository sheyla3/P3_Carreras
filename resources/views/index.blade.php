<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Caballos</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="app.css">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body>
    <nav class="navbar bg-body-tertiary" id="navbar">
        <div class="container-fluid">
            <img src="{{ asset('img/logoCaballo.png') }}" alt="">
        </div>
    </nav>

    <header>
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">HOME</a>
                <a class="navbar-brand" href="#">CARRITO</a>
                <a class="navbar-brand" href="#">RECORD</a>
                <a class="navbar-brand" href="#">TICKETS</a>

            </div>
        </nav>
    </header>
    
        <h1>Home</h1>
        <a class="linkAdminLogin" href="{{ route('loginAdmin') }}"> Panel Administrador</a>
        
    </body>
</html>
