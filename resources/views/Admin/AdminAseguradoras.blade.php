<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AseguradoraController;

//<td><a href="{{ route('editar.aseguradora', $aseguradora->id_aseguradora) }}">Editar</a></td>

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
    @include('layouts.cabAdmin')
    <div>
        <h1>Aseguradoras</h1>
        <form>
            @csrf
            <input type="submit" value="Buscar">
            <input type="text" id="buscar" name="buscar" placeholder="Buscar"><br>
            {!! $errors->first('buscar', '<small>:message</small>') !!}
        </form>
        <a href="{{ route('formularioAseguradora') }}">Añadir</a>
        <br>
        <hr>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>CIF</th>
                    <th>nombre</th>
                    <th>calle</th>
                    <th>precio</th>
                    <th>activo</th>
                    <th>Ediar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aseguradoras as $aseguradora)
                    <tr>
                        <td>{{ $aseguradora->id }}</td>
                        <td>{{ $aseguradora->CIF }}</td>
                        <td>{{ $aseguradora->nombre }}</td>
                        <td>{{ $aseguradora->calle }}</td>
                        <td>{{ $aseguradora->precio }}€</td>
                        <td>{{ $aseguradora->activo ? 'Sí' : 'No' }}</td>
                        <td>Editar</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
