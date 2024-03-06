<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JineteController;

//<td><a href="{{ route('editar.jinete', $jinete->id_jinete) }}">Editar</a></td>
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caballos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar bg-body-tertiary" id="navbar">
    <div class="container-fluid">
        <img src="{{ asset('img/logoCaballo.png') }}" alt="">
    </div>
</nav>

<nav class="navbar bg-body-tertiary" id="navbar2">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('AdminCarreras') }}">Carreras</a>
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

    <div class="container">
        <h1>Jinetes</h1>
        <form>
            @csrf
            <input type="submit" value="Buscar" class="btn btn-primary">
            <input type="text" id="buscar" name="buscar" placeholder="Buscar" class="form-control"><br>
            {!! $errors->first('buscar', '<small class="text-danger">:message</small>') !!}
        </form>
        <a href="{{ route('formularioJinete') }}">Añadir</a>
        <br>
        <hr>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Telf</th>
                    <th>Calle</th>
                    <th>Num federat</th>
                    <th>Edad</th>
                    <th>Activo</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jinetes as $jinete)
                    <tr>
                        <td>{{ $jinete->id_jinete }}</td>
                        <td>{{ $jinete->nombre }}</td>
                        <td>{{ $jinete->apellido }}</td>
                        <td>{{ $jinete->correo }}</td>
                        <td>{{ $jinete->contrasena }}</td>
                        <td>{{ $jinete->telf }}</td>
                        <td>{{ $jinete->calle }}</td>
                        <td>{{ $jinete->num_federat }}</td>
                        <td>{{ $jinete->edad }}</td>
                        <td>{{ $jinete->activo ? 'Sí' : 'No' }}</td>
                        <td><a href="{{ route('editar.jinete', $jinete->id_jinete) }}" class="btn btn-warning">Editar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('adminSponsors') }}">Sponsor</a>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

