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
    <style>
        .perfil-item {
            width: 48%; /* El 48% para dejar un pequeño espacio entre las dos columnas */
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    @if (isset($socioId) && isset($socioName))
        @include('layouts.CHSocio')
    @else
        @include('layouts.CaballoHeader')
    @endif

    <div class="enlacesHeader">
        <h1 class="float-left tituloHeader2">{{ $socio->nombre}}</h1>
    </div>

    <div class="perfil-container d-flex justify-content-center my-4">
        <div class="perfil-item">
            <h2 class="text-center">
                Información Personal
                <a href="{{ route('editarSocio', $socio->id_usuario) }}" class="btn btn-info"><img src="{{ asset('img/editar.svg') }}" alt="editar" height="25" width="25"></a>
            </h2>
            <hr class="my-2">
            <p><strong>Nombre:</strong> {{ $socio->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $socio->apellido }}</p>
            <p><strong>Correo:</strong> {{ $socio->correo }}</p>
            <p><strong>Teléfono:</strong> {{ $socio->telf }}</p>
            <p><strong>DNI:</strong> {{ $socio->dni }}</p>
            <p><strong>Edad:</strong> {{ \Carbon\Carbon::parse($socio->edad)->format('d-m-Y') }}</p>
        </div>
    </div>
</body>
@include('layouts.footer')
</html>
