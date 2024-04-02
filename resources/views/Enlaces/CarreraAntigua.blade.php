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
    @if (isset($socioId) && isset($socioName))
        @include('layouts.CHSocio')
    @elseif (isset($jineteId) && isset($jineteName))
        @include('layouts.CHJinete')
    @else
        @include('layouts.CaballoHeader')
    @endif
    <div class="enlacesHeader">
        <h1 class="float-left tituloHeader2">Record</h1>
        @include('layouts.2Header')
    </div>
    <div class="contenedor-tickets">
        <div class="carrera">
            <div class="datos">
                <div id="datos-title">
                    <h3>{{ $carrera->nombre }}</h3>
                </div>
                <div>
                    <p>{{ $carrera->descripcion }}</p>
                </div>
                <div>
                    <p>{{ $carrera->tipo }} de {{ $carrera->km }}km</p>
                </div>
                <div>
                    <p>{{ $carrera->fechaHora }}</p>
                </div>
            </div>
        </div>

    </div>
    <div class="b-example-divider"></div>
    <div class="row overflow-auto">
        <div class="col">
            <img src="{{ asset('storage/' . $carrera->cartel) }}" alt="Cartel de {{ $carrera->nombre }}" width="500" height="500">
        </div>
        <div class="col">
            <img src="{{ asset('storage/' . $carrera->lugar_foto) }}" alt="Lugar de {{ $carrera->nombre }}" width="500" height="500">
        </div>
    </div>
    <div class="b-example-divider"></div>
    <div>
        @if ($fotos->isEmpty())
            <p>De momento no hay fotos</p>
        @else
            <div class="collage">
                @foreach ($fotos as $carreraFoto)
                    <div class="collage-item">
                        <img src="{{ asset('storage/' . $carreraFoto->foto) }}" alt="{{ $carreraFoto->id_foto }}">
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>

</html>
