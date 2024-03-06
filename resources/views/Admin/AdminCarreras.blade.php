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
        <h1>Carreras</h1>
        <!-- Utiliza un formulario para enviar una solicitud POST al crear una carrera -->
        <form action="{{ route('carreras.create') }}" method="GET">
            @csrf <!-- Agrega el token CSRF para protección contra falsificación de solicitudes entre sitios -->
            <button type="submit" class="btn btn-primary">Añadir Carrera</button>
        </form>
        
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Tipo</th>
                    <th>Aforo</th>
                    <th>Fecha y Hora</th>
                    <!-- <th>Cartel</th> -->
                    <th>Patrocinio</th>
                    <th>Precio</th>
                    <th>Activo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carreras as $carrera)
                <tr>
                    <td>{{ $carrera->id_carrera }}</td>
                    <td>{{ $carrera->nombre }}</td>
                    <td>{{ $carrera->descripcion }}</td>
                    <td>{{ $carrera->tipo }}</td>
                    <td>{{ $carrera->aforo }}</td>
                    <td>{{ $carrera->fechaHora }}</td>
                    <!-- <td>{{ $carrera->cartel }}</td> -->
                    <td>{{ $carrera->patrocinio }}</td>
                    <td>{{ $carrera->precio }}</td>
                    <td>{{ $carrera->activo }}</td>

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
