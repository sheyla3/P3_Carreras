<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Caballos</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    </head>
    <body>
        <div class="subheader">
            <img src="{{ asset('img/caballoLogo.png') }}" alt="caballo">
            <a href="{{ route('loginAdmin') }}">Iniciar Sesión</a>
            <a href="">Registrarse</a>
        </div>
        <header>
            <a href="">HOME</a>
            <a href="">CARRITO</a>
            <a href="">RECORD</a>
            <a href="">TICKETS</a>
        </header>

        <div id="banner">
            <img src="{{ asset('img/banner1.png') }}" alt="horse">
            <img src="{{ asset('img/banner2.png') }}" alt="horse">
            <img src="{{ asset('img/banner3.png') }}" alt="horse">
        </div>
        <script src="{{ asset('js/banner.js') }}"></script>
        <div class="first-info">
        <button>READ MORE</button>
        <button style="background: #1B252B;">GET A QUOTE</button>
        </div>

        <!-- <div class="container-1">
            <img src="{{ asset('img/blackhorse.png') }}" alt="">
        </div> -->

    </body>

</html>
