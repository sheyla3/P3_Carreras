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
                <h1>Aseguradoras</h1>
            </li>
            <li class="float-right ml-4">
                <form action="{{ route('formularioAseguradora') }}" method="GET">
                    @csrf
                    <button type="submit" class="d-inline p-2 btn btn-primary"><img src="{{ asset('img/mas.svg') }}"
                            alt="+" width="30" height="30"></button>
                </form>
            </li>
            <li class="float-right">
                <form action="{{ route('buscarAseguradora') }}" method="GET">
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
                    <th>Nombre</th>
                    <th>Calle</th>
                    <th>Precio</th>
                    <th>Activo</th>
                    <th>Editar</th>
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
                        <td>
                            @if ($aseguradora->activo)
                                <a class="btn btn-success" href="{{ route('inactivoAseguradora', $aseguradora->id) }}">Sí</a>
                            @else
                                <a class="btn btn-danger" href="{{ route('activoAseguradora', $aseguradora->id) }}">No</a>
                            @endif
                        </td>
                        <td><a class="btn btn-dark"
                                href="{{ route('editarAseguradora', $aseguradora->id) }}">Editar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
