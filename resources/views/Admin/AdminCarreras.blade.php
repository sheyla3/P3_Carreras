<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Carreras</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layouts.cabAdmin')
    <div class="container">
        <ul class="mt-3 list-unstyled">
            <li>
                <h1>Carreras</h1>
            </li>
            <li class="float-right ml-4">
                <form action="{{ route('carreras.create') }}" method="GET">
                    @csrf
                    <button type="submit" class="d-inline btn btn-primary"><img src="{{ asset('img/mas.svg') }}"
                            alt="+" width="30" height="30"></button>
                </form>
            </li>
            <li class="float-right">
                <form method="GET">
                    @csrf
                    <div class="form-group row">
                        <button type="submit" class="btn btn-white">
                            <img src="{{ asset('img/lupa.svg') }}" alt="Buscar" width="20" height="20">
                        </button>
                        <div>
                            <input type="text" id="buscar" name="query" placeholder="Buscar" class="form-control">
                        </div>
                    </div>
                </form>
            </li>
        </ul>
        <br><br>
        <table class="table table-responsive-md">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Lugar</th>
                    <th scope="col">Aforo</th>
                    <th scope="col">Km</th>
                    <th scope="col">Fecha y Hora</th>
                    <th scope="col">Cartel</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Patrocinio</th>
                    <th scope="col">Activo</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody id="tabla-carreras">
                <!-- Aquí se mostrarán las carreras -->
                @foreach($carreras as $carrera)
                <tr>
                    <td>{{ $carrera->id_carrera }}</td>
                    <td>{{ $carrera->nombre }}</td>
                    <td width="170" style="overflow: auto">{{ $carrera->descripcion }}</td>
                    <td>{{ $carrera->tipo }}</td>
                    <td>
                        @if($carrera->lugar_foto)
                        <img src="{{ asset('storage/' . $carrera->lugar_foto) }}" width="60" height="40" alt="lugar de {{ $carrera->nombre }}">
                        @else
                        Sin foto
                        @endif
                    </td>
                    <td>{{ $carrera->aforo }}</td>
                    <td>{{ $carrera->km }}</td>
                    <td>{{ $carrera->fechaHora }}</td>
                    <td>
                        @if($carrera->cartel)
                        <img src="{{ asset('storage/' . $carrera->cartel) }}" width="30" height="40" alt="cartel de {{ $carrera->nombre }}">
                        @else
                        Sin foto
                        @endif
                    </td>
                    <td>{{ $carrera->precio }}€</td>
                    <td><a class="btn btn-info" href="/patrocinioCarrera/{{ $carrera->id_carrera }}">Patrocinio</a></td>
                    <td>
                        @if($carrera->activo)
                        <a class="btn btn-success" href="/inactivoCarrera/{{ $carrera->id_carrera }}">Sí</a>
                        @else
                        <a class="btn btn-danger" href="/activoCarrera/{{ $carrera->id_carrera }}">No</a>
                        @endif
                    </td>
                    <td><a class="btn btn-dark" href="/editarCarrera/{{ $carrera->id_carrera }}">Editar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
