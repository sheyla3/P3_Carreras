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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        <h2 class="float-left tituloHeader2">Editar {{ $socio->nombre}}</h2>
    </div>

    <div class="perfil-container d-flex justify-content-center my-4">
        <div class="perfil-item">
            <form action="{{ route('editar.socio', $socio->id_usuario) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" value="{{ $socio->correo ?? '' }}">
        </div>
        <div class="form-group">
            <label for="contrasena">Nueva contraseña:</label>
            <div class="input-group">
                <input type="password" class="form-control" id="contrasena" name="contrasena">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $socio->nombre ?? '' }}">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $socio->apellido ?? '' }}">
        </div>
        <div class="form-group">
            <label for="telf">Teléfono:</label>
            <input type="tel" class="form-control" id="telf" name="telf" value="{{ $socio->telf ?? '' }}">
        </div>
        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" class="form-control" id="dni" name="dni" value="{{ $socio->dni ?? '' }}">
        </div>
        <div class="form-group">
            <label for="edad">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="edad" name="edad" value="{{ isset($socio->edad) ? \Carbon\Carbon::parse($socio->edad)->format('Y-m-d') : '' }}">
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('contrasena');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePassword.addEventListener('click', function() {
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.remove('fa-eye');
                    eyeIcon.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('fa-eye-slash');
                    eyeIcon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
@include('layouts.footer')
</html>
