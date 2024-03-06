<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\sponsorController;

//<td><a href="{{ route('editar.sponsor', $sponsor->id_sponsor) }}">Editar</a></td>

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
        <h1>sponsors</h1>
        <form>
            @csrf
            <input type="submit" value="Buscar">
            <input type="text" id="buscar" name="buscar" placeholder="Buscar"><br>
            {!! $errors->first('buscar', '<small>:message</small>') !!}
        </form>
        <a href="{{ route('formularioSponsor') }}">Añadir</a>
        <br>
        <hr>
        <br>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>CIF</th>
                    <th>nombre</th>
                    <th>logo</th>
                    <th>calle</th>
                    <th>destacado</th>
                    <th>activo</th>
                    <th>Ediar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sponsors as $sponsor)
                    <tr>
                        <td>{{ $sponsor->id_sponsor }}</td>
                        <td>{{ $sponsor->CIF }}</td>
                        <td>{{ $sponsor->nombre }}</td>
                        <td>
                            @if ($sponsor->logo)
                            <img src="{{ storage_path('app/public/' . $sponsor->logo) }}" alt="Logo">
                            @else
                                Sin logo
                            @endif
                        </td>
                        <td>{{ $sponsor->calle }}</td>
                        <td>{{ $sponsor->destacado ? 'Sí' : 'No' }}</td>
                        <td>{{ $sponsor->activo ? 'Sí' : 'No' }}</td>
                        <td>Editar</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('adminJinetes') }}">Jinetes</a>
    </div>
</body>

</html>
