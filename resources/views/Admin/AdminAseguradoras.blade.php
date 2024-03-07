<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AseguradoraController;

//<td><a href="{{ route('editar.aseguradora', $aseguradora->id_aseguradora) }}">Editar</a></td>

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
                <h1>Aseguradoras</h1>
            </li>
            <li class="float-right ml-4">
                <form action="{{ route('formularioAseguradora') }}" method="GET">
                    @csrf
                    <button type="submit" class="d-inline p-2 btn btn-primary">Añadir Jinete</button>
                </form>
            </li>
            <li class="float-right">
                <form>
                    @csrf
                    <div class="form-group row">
                        <button type="submit" class="col-sm-2 btn btn-white">
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
                    <th>calle</th>
                    <th>precio</th>
                    <th>activo</th>
                    <th>Ediar</th>
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
                            <form action="{{ route('cambiarActivo', $aseguradora->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-info">
                                    {{ $aseguradora->activo ? 'Sí' : 'No' }}
                                </button>
                            </form>
                        </td>
                        <td><a class="btn btn-dark" href="{{ route('editarAseguradora', $aseguradora->id) }}" >Editar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if (session('Estado'))
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
                    {{ session('Estado') }}
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
</body>
<script>
    function cambiarEstado(id, url) {
        // Realizar una solicitud AJAX para cambiar el estado activo
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Cambiar el texto y la clase del botón en consecuencia
            const button = document.querySelector(`button[data-id="${id}"]`);
            button.innerText = data.activo ? 'Sí' : 'No';
            button.classList.remove('btn-success', 'btn-danger');
            button.classList.add(`btn-${data.activo ? 'success' : 'danger'}`);
        })
        .catch(error => console.error('Error:', error));
    }
</script>
</html>
