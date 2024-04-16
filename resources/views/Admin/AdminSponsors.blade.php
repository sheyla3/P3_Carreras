<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\sponsorController;
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
    <div class="container">
        <ul class="mt-3 list-unstyled">
            <li>
                <h1>Sponsors</h1>
            </li>
            <li class="float-right ml-4">
                <form action="{{ route('formularioSponsor') }}" method="GET">
                    @csrf
                    <button type="submit" class="d-inline p-2 btn btn-primary"><img src="{{ asset('img/mas.svg') }}" alt="+" width="30" height="30"></button>
                </form>
            </li>
            <li class="float-right">
                <form>
                    @csrf
                    <div class="form-group row">
                        <button type="submit" class="btn btn-white">
                            <img src="{{ asset('img/lupa.svg') }}" alt="Buscar" width="20" height="20">
                        </button>
                        <div>
                            <input type="text" id="buscar" name="buscar" placeholder="Buscar"
                                class="form-control">
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
                                <img src="{{ asset('storage/' . $sponsor->logo) }}" width="60" height="40" alt="Logo {{ $sponsor->nombre }}">
                            @else
                                Sin logo
                            @endif
                        </td>
                        <td>{{ $sponsor->calle }}</td>
                        <td>{{ $sponsor->destacado ? 'Sí' : 'No' }}
                            @if ($sponsor->destacado == true)
                                <a href="{{ route('FacturaSponsor', $sponsor->id_sponsor) }}" class="btn btn-info ml-2">Factura</a>
                            @endif
                        </td>
                        <td>
                            @if ($sponsor->activo)
                                <a class="btn btn-success" href="{{ route('inactivoSponsor', $sponsor->id_sponsor) }}">Sí</a>
                            @else
                                <a class="btn btn-danger" href="{{ route('activoSponsor', $sponsor->id_sponsor) }}">No</a>
                            @endif
                        </td>
                        <td><a class="btn btn-dark"
                                href="{{ route('editarSponsor', $sponsor->id_sponsor) }}">Editar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
