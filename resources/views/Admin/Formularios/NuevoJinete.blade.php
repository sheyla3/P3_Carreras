<?php
use App\Http\Controllers\JineteController;
?>
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

<body class="FondoAdmin">
    <div>
        <h1>Añadir Jinete</h1>
        <form action="{{ route('jinete.nuevo') }}" method="POST">
            @csrf
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"><br>
            {!! $errors->first('nombre', '<small>:message</small>') !!}<br>
            <label for="apellido">Apellido:</label><br>
            <input type="text" id="apellido" name="apellido" value="{{ old('apellido') }}"><br>
            {!! $errors->first('apellido', '<small>:message</small>') !!}<br>
            <label for="correo">Email:</label><br>
            <input type="text" id="correo" name="correo" value="{{ old('correo') }}" ><br>
            {!! $errors->first('correo', '<small>:message</small>') !!}<br>
            <label for="contra">Contraseña:</label><br>
            <input type="password" id="contra" name="contra" value="{{ old('contra') }}"><br>
            {!! $errors->first('contra', '<small>:message</small>') !!}<br>
            <label for="telf">Teléfono:</label><br>
            <input type="text" id="telf" name="telf" value="{{ old('telf') }}"><br>
            {!! $errors->first('telf', '<small>:message</small>') !!}<br>
            <label for="calle">Calle:</label><br>
            <input type="text" id="calle" name="calle" value="{{ old('calle') }}"><br>
            {!! $errors->first('calle', '<small>:message</small>') !!}<br>
            <label for="num_fede">Número de federación:</label><br>
            <input type="text" id="num_fede" name="num_fede" value="{{ old('num_fede') }}"><br>
            {!! $errors->first('num_fede', '<small>:message</small>') !!}<br>
            <label for="edad">Edad:</label><br>
            <input type="date" id="edad" name="edad" value="{{ old('edad') }}"><br>
            {!! $errors->first('edad', '<small>:message</small>') !!}<br><br>
            <input type="submit" value="Guardar">
        </form>
        <a href="{{ route('adminJinetes') }}">Atras</a>
    </div>    
</body>

</html>