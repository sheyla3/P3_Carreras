<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Carreras</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Agrega los enlaces a los archivos CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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

    @if (session('Añadido'))
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
                        {{ session('Añadido') }}
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
    
    <!-- Añadir fotos -->
    <div class="modal fade" id="modalAgregarFoto" tabindex="-1" role="dialog" aria-labelledby="modalAgregarFotoLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAgregarFotoLabel">Agregar Fotos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formAgregarFoto" action="{{ route('anadirFoto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="carrera_id" id="carreraIdInput">
                        <div id="dropArea" class="drop-area" style="height: 200px">
                            <p id="numImagenes">Arrastra y suelta tus imágenes aquí o haz clic para seleccionarlas.</p>
                            <input type="file" name="fotos[]" id="fileInput" multiple style="display: none;">
                        </div>
                        <br>
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
    //Abrir modal
    $(document).ready(function() {
        $('.btn-abrir-modal1').click(function() {
            var carreraId = $(this).data('id');
            $('#modalAgregarFoto').modal('show');
            $('#carreraIdInput').val(carreraId); 
        });
    });

    //Funcion drag and drop
    document.addEventListener("DOMContentLoaded", function () {
        const dropArea = document.getElementById("dropArea");
        const fileInput = document.getElementById("fileInput");
        const numImagenes = document.getElementById("numImagenes");

        dropArea.addEventListener("dragover", function (e) {
            e.preventDefault();
            dropArea.classList.add("dragover");
        });

        dropArea.addEventListener("dragleave", function () {
            dropArea.classList.remove("dragover");
        });

        dropArea.addEventListener("drop", function (e) {
            e.preventDefault();
            dropArea.classList.remove("dragover");
            const files = e.dataTransfer.files;
            fileInput.files = files;
            ActulalizarNumImagenes(files);
        });

        dropArea.addEventListener("click", function () {
            fileInput.click();
        });

        fileInput.addEventListener("change", function () {
            const files = fileInput.files;
            ActulalizarNumImagenes(files);
        });

        function ActulalizarNumImagenes(files) {
            if (files.length > 0) {
                const fileNames = Array.from(files).map(file => file.name);
                numImagenes.innerText = `Se han seleccionado ${files.length} imágenes: ${fileNames.join(", ")}`;
            } else {
                numImagenes.innerText = "Arrastra y suelta tus imágenes aquí o haz clic para seleccionarlas.";
            }
        }
    });
</script>
</html>
