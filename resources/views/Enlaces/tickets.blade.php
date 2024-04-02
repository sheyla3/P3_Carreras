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
    <script src="https://www.paypal.com/sdk/js?client-id=AWbHTcaJ9_9CZ3ZREICbLJos0DmP1hnmv9pIg3jX-Qj9XAY5IGuiaakjVWdsGIyHcyhX7cs3Jqv8OVGo&currency=USD"></script>

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
                <img src="{{ asset('storage/'.$carrera->lugar_foto) }}" width="378px" height="342px" alt="">
            </div>

        <div class="datos">
            <div id="datos-title">
                <h3>{{ $carrera->nombre }}</h3>
            </div>
            <div>
                <p>Lugar: {{ $carrera->descripcion }}</p>
            </div>
            <div>
                <p>{{ $carrera->precio }} €</p>
            </div>
        </div>

        <div class="jinetes">
            <a href="">Jinetes</a>
        </div>

        <div class="clasificacion" id="paypal-button-container">
            <button>Ver clasificacion</button>
            <script>
                paypal.Buttons().render('paypal-button-container')
            </script>
        </div>
        </div>
    @endforeach
</div>

<div></div>
<script>
    paypal.Buttons().render('#paypal-button-container')
</script>
</body>
</html>
