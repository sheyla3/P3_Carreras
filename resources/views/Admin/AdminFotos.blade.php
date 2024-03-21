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
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Añadir</th>
                    <th>Ver fotos</th>
                </tr>
            </thead>
            <tbody>
                @if ($carreras->count() > 0)
                    @foreach ($carreras as $carrera)
                        <tr>

                            <td>{{ $carrera->id_carrera }}</td>
                            <td>{{ $carrera->nombre }}</td>
                            <td>
                                <button class="btn btn-info btn-abrir-modal1" data-id="{{ $carrera->id_carrera }}">
                                    <img src="{{ asset('img/mas.svg') }}" alt="+" width="20" height="20">
                                </button>
                            </td>
                            <td>
                                <a class="btn btn-dark" href="{{ route('verFotos', $carrera->id_carrera) }}">
                                    Fotos
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">No hay carreras activas</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Añadir fotos -->
    <div class="modal fade" id="modalAgregarFoto" tabindex="-1" role="dialog" aria-labelledby="modalAgregarFotoLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarFotoLabel">Agregar Fotos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('anadirFoto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="carrera_id" id="carreraIdInput">
                        <input type="file" name="fotos[]" multiple><br><br>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Subir Fotos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        $('.btn-abrir-modal1').click(function() {
            var carreraId = $(this).data('id');
            $('#modalAgregarFoto').modal('show');
            $('#carreraIdInput').val(
                carreraId); // Inserta el ID de la carrera en un input oculto en el formulario
        });
    });
</script>
</html>