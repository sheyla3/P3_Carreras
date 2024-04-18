<?php
use App\Http\Controllers\SocioController;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Administración - Socios</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>

<body>
    @include('layouts.cabAdmin')
    <div class="container">
        <ul class="mt-3 list-unstyled">
            <li>
                <h1>Socios</h1>
            </li>
            <li class="float-right ml-4">
                <form action="{{ route('formularioSocio') }}" method="GET">
                    @csrf
                    <button type="submit" class="d-inline p-2 btn btn-primary"><img src="{{ asset('img/mas.svg') }}" alt="+" width="30" height="30"></button>
                </form>
            </li>
            <li class="float-right">
                <form action="{{ route('buscarSocios') }}" method="GET">
                    @csrf
                    <div class="form-group row">
                        <button type="submit" class="btn btn-white">
                            <img src="{{ asset('img/lupa.svg') }}" alt="Buscar" width="20" height="20">
                        </button>
                        <div>
                            <input type="text" id="buscar" name="buscar" placeholder="Buscar" class="form-control">
                        </div>
                    </div>
                </form>
            </li>
        </ul>
        <br><br>
        <table class="table table-responsive-md">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Teléfono</th>
                    <th>DNI</th>
                    <th>Fecha de Nacimiento</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($socios as $socio)
                    <tr>
                        <td>{{ $socio->id_usuario }}</td>
                        <td>{{ $socio->nombre }}</td>
                        <td>{{ $socio->apellido }}</td>
                        <td>{{ $socio->correo }}</td>
                        <td>**********</td>
                        <td>{{ $socio->telf }}</td>
                        <td>{{ $socio->dni }}</td>
                        <td>{{ \Carbon\Carbon::parse($socio->fechaHora)->format('d-m-Y') }}</td>
                        <td>{{ $socio->formatted_edad }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
