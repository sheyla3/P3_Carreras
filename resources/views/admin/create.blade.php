<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Carrera</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layouts.cabAdmin')
    <div class="container">
        <h1>Crear Carrera</h1>
        <!-- Formulario para crear una nueva carrera -->
        <form action="{{ route('carreras.store') }}" method="post" enctype="multipart/form-data">
            @csrf <!-- Agrega el token CSRF para protección contra falsificación de solicitudes entre sitios -->
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
                <span id="contadorCaracteres"></span>/1000
            </div>

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" class="form-control">
                    <option value="plano">Plano</option>
                    <option value="vallas">Vallas</option>
                    <option value="campo a traves">Campo a través</option>
                    <option value="trote y arnes">Trote y arnes</option>
                    <option value="parejeras">Parejeras</option>
                </select>
            </div>

            <div class="form-group">
                <label for="lugar_foto">Foto del lugar:</label>
                <input type="file" id="lugar_foto" name="lugar_foto" class="form-control">
            </div>

            <div class="form-group">
                <label for="km">Distancia en km:</label>
                <input type="number" id="km" name="km" class="form-control">
            </div>

            <div class="form-group">
                <label for="fechaHora">Fecha y Hora:</label>
                <input type="datetime-local" id="fechaHora" name="fechaHora" class="form-control">
            </div>

            <div class="form-group">
                <label for="cartel">Cartel:</label>
                <input type="file" id="cartel" name="cartel" class="form-control">
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <a href="{{ route('AdminCarreras') }}" class="btn btn-secondary">Atrás</a>
    </div>
    @if (session('Guardado'))
        <div class="modal" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ session('Guardado') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#successModal').modal('show');
            });
        </script>
    @endif

    @if ($errors->any())
        <div class="modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#errorModal').modal('show');
            });
        </script>
    @endif

    <!-- Agrega los enlaces a los archivos JavaScript de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script>
    function mostrarCaracteres(textareaElement, contadorElement) {
        contadorElement.innerText = textareaElement.value.length;
    }

    document.addEventListener('DOMContentLoaded', function() {
        let descripcion = document.getElementById('descripcion');
        let contadorCaracteres = document.getElementById('contadorCaracteres');

        mostrarCaracteres(descripcion, contadorCaracteres);
        descripcion.addEventListener('input', function() {
            mostrarCaracteres(descripcion, contadorCaracteres);
        });
    });
</script>
</html>
