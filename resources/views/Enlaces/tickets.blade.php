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
    <div class="right-links">
        <a href="{{ route('loginAdmin') }}" class="btn btn-primary">Iniciar Sesion</a>
        <a href="{{ route('loginAdmin') }}" class="btn btn-primary">Registrarme</a>
    </div>
</nav>

<header class="header-secundario">
    <nav class="navbar bg-body-tertiary" >
        <div class="container-fluid" id="listaHeader">
        <h1>TICKETS</h1>
            <a class="navbar-brand" href="#">HOME</a>
            <a class="navbar-brand" href="#">CARRITO</a>
            <a class="navbar-brand" href="#">RECORD</a>
            <a class="navbar-brand" href="{{ route('tickets') }}">TICKETS</a>
        </div>
    </nav>
</header>
    
<div class="contenedor-tickets">
    @foreach($carreras as $carrera)
        <div class="carrera">
            <div>
                <img src="{{ asset('img/prueba.png') }}" alt="">
            </div>
            <div>
                <h3>{{ $carrera->nombre }}</h3>
            </div>
            <div>
                <p>{{ $carrera->descripcion }}</p>
            </div>
            <div>
                <p>Precio: ${{ $carrera->precio }}</p>
            </div>
        </div>
    @endforeach
</div>

</body>
</html>
