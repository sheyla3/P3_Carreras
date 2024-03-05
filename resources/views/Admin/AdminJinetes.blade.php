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

    <!-- Fonts -->
    <link rel="stylesheet" href="app.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

</head>

<body>
    <div>
        <h1>Jinetes</h1>
        <form>
            @csrf
            <input type="submit" value="Buscar">
            <input type="text" id="buscar" name="buscar" placeholder="Buscar"><br>
            {!! $errors->first('buscar', '<small>:message</small>') !!}
        </form>
        <a href="{{ route('NuevoJinete') }}">Añadir</a>
        <br>
        <hr>
        <br>
        <table>
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
                    <th>Ediar</th>
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
                        <td>Editar</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
