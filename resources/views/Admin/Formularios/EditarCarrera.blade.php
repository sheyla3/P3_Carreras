<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Carrera</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>

<body class="FondoAdmin">
    @include('layouts.cabAdmin')
    <div class="container">
        <h1>Editar Carrera</h1>
        <form action="{{ route('carrera.editar', $carrera->id_carrera) }}" method="POST" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control"
                    value="{{ $carrera->nombre ?? '' }}">
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" class="form-control">{{ $carrera->descripcion ?? '' }}</textarea>
                <span id="contadorCaracteres"></span>/1000
            </div>

            <div class="form-group">
                <label for="tipo">Tipo:</label>
                <select id="tipo" name="tipo" class="form-control">
                    <option value="plano" {{ $carrera->tipo == 'plano' ? 'selected' : '' }}>Plano</option>
                    <option value="vallas" {{ $carrera->tipo == 'vallas' ? 'selected' : '' }}>Vallas</option>
                    <option value="campo a traves" {{ $carrera->tipo == 'campo a traves' ? 'selected' : '' }}>Campo a
                        través</option>
                    <option value="trote y arnes" {{ $carrera->tipo == 'trote y arnes' ? 'selected' : '' }}>Trote y
                        arnes</option>
                    <option value="parejeras" {{ $carrera->tipo == 'parejeras' ? 'selected' : '' }}>Parejeras</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="lugar_foto" class="form-label">Foto del lugar Actual:</label><br>
                @if (isset($carrera->lugar_foto))
                    <img src="{{ asset('storage/' . $carrera->lugar_foto) }}" alt="Foto del lugar Actual"
                        style="max-width: 200px; max-height: 200px;">
                @else
                    <p>No hay foto del lugar disponible</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="cartel" class="form-label">Nueva foto del lugar:</label>
                <input type="file" id="cartel" name="cartel" class="form-control"
                    value="{{ asset($carrera->lugar_foto) }}">
            </div>

            <div class="form-group">
                <label for="km">Distancia en km:</label>
                <input type="number" id="km" name="km" class="form-control"
                    value="{{ $carrera->km ?? '' }}">
            </div>

            <div class="form-group">
                <label for="fechaHora">Fecha y Hora:</label>
                <input type="datetime-local" id="fechaHora" name="fechaHora" class="form-control"
                    value="{{ $carrera->fechaHora ?? '' }}">
            </div>

            <div class="mb-3">
                <label for="cartel" class="form-label">Cartel Actual:</label><br>
                @if (isset($carrera->cartel))
                    <img src="{{ asset('storage/' . $carrera->cartel) }}" alt="Cartel Actual"
                        style="max-width: 200px; max-height: 200px;">
                @else
                    <p>No hay Cartel disponible</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="cartel" class="form-label">Nuevo Cartel:</label>
                <input type="file" id="cartel" name="cartel" class="form-control" value="{{ asset($carrera->cartel) }}">
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" class="form-control"
                    value="{{ $carrera->precio ?? '' }}">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <a href="{{ route('AdminCarreras') }}" class="btn btn-secondary">Atrás</a>
    </div>
    @if (session('Editado'))
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
                        {{ session('Editado') }}
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
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
