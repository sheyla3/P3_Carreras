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
    <script
        src="https://www.paypal.com/sdk/js?client-id=AWbHTcaJ9_9CZ3ZREICbLJos0DmP1hnmv9pIg3jX-Qj9XAY5IGuiaakjVWdsGIyHcyhX7cs3Jqv8OVGo&currency=USD">
    </script>

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
        <h1 class="float-left tituloHeader2">Participantes</h1>
        @include('layouts.2Header')
    </div>
    <div class="mt-2 ml-5">
        <a href="{{ route('tickets') }}"><img src="{{ asset('img/atras1.png') }}" width="60" height="60"
                alt="atras"><img src="{{ asset('img/atras2.png') }}" width="60" height="60"
                alt="atras"></a>
    </div>
    <div class="contenedor-tickets">
        <div class="row">
            @foreach ($jinetes as $jinete)
                <div class="col-md-6">
                    <div class="carrera">
                        <div class="carrera-img">
                            <img src="{{ asset('storage/' . $jinete->foto) }}" width="378px" height="342px"
                                alt="{{ $jinete->nombre }}">
                        </div>

                        <div class="datos">
                            <div id="datos-title">
                                <h3>Nombre: {{ $jinete->nombre }}</h3>
                            </div>
                            <div id="datos-title">
                                <h3>Apellido: {{ $jinete->apellido }}</h3>
                            </div>
                            <div id="datos-title">
                                <h3>Edad: {{ \Carbon\Carbon::parse($jinete->edad)->format('d-m-Y') }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
