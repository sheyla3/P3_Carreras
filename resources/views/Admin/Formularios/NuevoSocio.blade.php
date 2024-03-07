<?php
use App\Http\Controllers\SocioController;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Añadir Socio</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
@include('layouts.cabAdmin')

<div class="container">
    <h1>Añadir Socio</h1>
    <form action="{{ route('guardar.socio') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="form-group">
            <label for="telf">Teléfono:</label>
            <input type="tel" class="form-control" id="telf" name="telf" required>
        </div>
        <div class="form-group">
            <label for="dni">DNI:</label>
            <input type="text" class="form-control" id="dni" name="dni" required>
        </div>
        <div class="form-group">
            <label for="edad">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" id="edad" name="edad" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

</body>
</html>
