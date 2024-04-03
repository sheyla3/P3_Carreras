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
    @if (isset($socioId) && isset($socioName))
        @include('layouts.CHSocio')
    @elseif (isset($jineteId) && isset($jineteName))
        @include('layouts.CHJinete')
    @else
        @include('layouts.CaballoHeader')
    @endif
    <div class="enlacesHeader">
        <h1 class="float-left tituloHeader2">Tickets</h1>
        @include('layouts.2Header')
    </div>
    <div class="contenedor-tickets">
        @foreach ($carreras as $carrera)
            <div class="carrera">
                <div class="carrera-img">
                    <img src="{{ asset('storage/' . $carrera->lugar_foto) }}" width="378px" height="342px"
                        alt="">
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

                <div class="clasificacion">
                    <button>Ver clasificacion</button>
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
