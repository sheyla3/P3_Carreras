<?php
use App\Http\Controllers\SponsorController;
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

<nav class="navbar bg-body-tertiary" id="navbar">
    <div class="container-fluid">
        <img src="{{ asset('img/logoCaballo.png') }}" alt="">
    </div>
</nav>

<nav class="navbar bg-body-tertiary" id="navbar2">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Carreras</a>
    <a class="navbar-brand" href="#">Sponsors</a>
    <a class="navbar-brand" href="#">Aseguradoras</a>
  </div>
</nav>

<nav class="navbar bg-body-tertiary" id="navbar3">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('AdminJinetes') }}">Jinetes</a>
    <a class="navbar-brand" href="#">Socios</a>
    <a class="navbar-brand" href="#">Fotos</a>
  </div>
</nav>

    <div>
        <h1>Añadir Sponsor</h1>
        <form action="{{ route('sponsor.nuevo') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="cif">CIF:</label><br>
            <input type="text" id="cif" name="cif" value="{{ old('cif') }}"><br>
            {!! $errors->first('cif', '<small>:message</small>') !!}<br>
            <label for="nombre">Nombre:</label><br>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}"><br>
            {!! $errors->first('nombre', '<small>:message</small>') !!}<br>
            <label for="logo">Logo:</label><br>
            <input type="file" id="logo" name="logo" accept="image/*"><br>
            {!! $errors->first('logo', '<small>:message</small>') !!}<br>
            <label for="calle">Calle:</label><br>
            <input type="text" id="calle" name="calle" value="{{ old('calle') }}"><br>
            {!! $errors->first('calle', '<small>:message</small>') !!}<br>
            <label for="destacado">Destacado:</label><br>
            <input type="checkbox" id="destacado" name="destacado" value="1"
                {{ old('destacado') ? 'checked' : '' }}>
            <br><br>
            <input type="submit" value="Guardar">
        </form>
        <a href="{{ route('AdminSponsors') }}">Atrás</a>
    </div>
</body>

</html>
