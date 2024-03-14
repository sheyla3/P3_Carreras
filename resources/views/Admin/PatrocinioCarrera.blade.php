<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Patrocinio</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    @include('layouts.cabAdmin')
    <div class="container">
        <ul class="mt-3 list-unstyled">
            <li>
                <h1>Patrocinio</h1>
            </li>
            <li class="float-right ml-4">
                <button id="btnAgregarPatrocinio" class="d-inline p-2 btn btn-primary"><img
                        src="{{ asset('img/mas.svg') }}" alt="+" width="30" height="30"></button>
            </li>
        </ul>
        <br><br>
        <table class="table table-responsive-md">
            <thead class="thead-dark">
                <tr>
                    <th>Id</th>
                    <th>Sponsor</th>
                    <th>Patrocinio</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sponsorCarreras as $sponsorCarrera)
                    <tr>
                        <td>{{ $sponsorCarrera->id_sponsorCarrera }}</td>
                        <td>{{ $sponsorCarrera->sponsor->nombre }}</td>
                        <td>{{ $sponsorCarrera->patrocinio }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('AdminCarreras') }}" class="btn btn-secondary">Atrás</a>
        @foreach ($sponsorsActivos as $sponsor)
            <p> id: {{ $sponsor->id_sponsor }}
                nombre: {{ $sponsor->nombre }}
            </p>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal" id="modalAgregarPatrocinio" tabindex="-1" role="dialog"
        aria-labelledby="modalAgregarPatrocinioLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarPatrocinioLabel">Añadir Patrocinio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('carrera.patrocinio', $idCarrera) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_sponsor">Sponsor:</label>
                            <select id="id_sponsor" name="id_sponsor" class="form-control">
                                @foreach ($sponsorsActivos as $sponsor)
                                    <option value="{{ $sponsor->id_sponsor }}">
                                        {{ $sponsor->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="patrocinio">Patrocinio:</label>
                            <input type="number" id="patrocinio" name="patrocinio" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Asigna el evento de clic al botón después de que el documento esté completamente cargado
            $('#btnAgregarPatrocinio').on('click', function(e) {
                // Prevén el comportamiento predeterminado del enlace
                e.preventDefault();
                // Muestra el modal
                $('#modalAgregarPatrocinio').modal('show');
            });
        });
    </script>
