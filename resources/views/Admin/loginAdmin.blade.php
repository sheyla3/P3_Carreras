<?php
use App\Http\Controllers\AdminController;
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
    <div class="ImgAdmin">
        <h1>Login Admin</h1>
        <form action="{{ route('admin.iniciar') }}" method="POST">
            @csrf
            <label for="usuario">Usuario:</label><br>
            <input type="text" id="usuario" name="usuario" value="{{ old('usuario') }}" placeholder="Usuario"><br>
            {!! $errors->first('usuario', '<small>:message</small>') !!}<br>
            <label for="contra">Contraseña:</label><br>
            <input type="password" id="contra" name="contra" value="{{ old('contra') }}"
                placeholder="Contraseña"><br>
            {!! $errors->first('contra', '<small>:message</small>') !!}<br><br>
            <input type="submit" value="Iniciar">
        </form>
        <a href="{{ route('/') }}">Home</a>
    </div>
</body>

</html>