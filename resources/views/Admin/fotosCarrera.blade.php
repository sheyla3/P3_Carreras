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
                <h1>Fotos</h1>
            </li>
            <li class="float-right ml-4">
                <a class="btn btn-danger" href="{{ route('eliminarTodasFotos', $idCarrera) }}">
                    Eliminar todas
                </a>
            </li>
            <li class="float-right">
                <p class="btn btn-warning">Eliminar</p>
            </li>
        </ul>
        <br><br>
        @if ($carreraFotos->isEmpty())
            <p>No hay fotos</p>
        @else
            <div class="collage">
                @foreach ($carreraFotos as $carrera)
                    <div class="collage-item">
                        <img src="{{ asset('storage/' . $carrera->foto) }}" alt="{{ $carrera->id_foto }}">
                    </div>
                @endforeach
            </div>
        @endif
        <br><br>
        <a href="{{ route('adminFotos') }}" class="btn btn-secondary">Atrás</a>
        <br><br>
    </div>
    <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
