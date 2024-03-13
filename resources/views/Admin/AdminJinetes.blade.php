<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JineteController;
// class btn btn-warning
//<td><a href="{{ route('editar.jinete', $jinete->id_jinete) }}" >Editar</a></td>
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Administración - Jinetes</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>

<body>
    @include('layouts.cabAdmin')
    <div class="container">
        <ul class="mt-3 list-unstyled">
            <li>
                <h1>Jinetes</h1>
            </li>
            <li class="float-right ml-4">
                <form action="{{ route('formularioJinete') }}" method="GET">
                    @csrf
                    <button type="submit" class="d-inline p-2 btn btn-primary"><img src="{{ asset('img/mas.svg') }}" alt="+" width="30" height="30"></button>
                </form>
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
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Contraseña</th>
                    <th>Foto</th>
                    <th>Telf</th>
                    <th>Calle</th>
                    <th>Num federat</th>
                    <th>Edad</th>
                    <th>Activo</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jinetes as $jinete)
                    <tr>
                        <td>{{ $jinete->id_jinete }}</td>
                        <td>{{ $jinete->nombre }}</td>
                        <td>{{ $jinete->apellido }}</td>
                        <td>{{ $jinete->correo }}</td>
                        <td>{{ $jinete->contrasena }}</td>
                        <td>
                            @if ($jinete->foto)
                                <img src="{{ asset('storage/' . $jinete->foto) }}" width="30" height="40" alt="{{ $jinete->nombre }}">
                            @else
                                Sin foto
                            @endif
                        </td>
                        <td>{{ $jinete->telf }}</td>
                        <td>{{ $jinete->calle }}</td>
                        <td>{{ $jinete->num_federat }}</td>
                        <td>{{ $jinete->formatted_edad }}</td>
                        <td>
                            <button class="btn {{ $jinete->activo ? 'btn-success' : 'btn-danger' }}"
                                onclick="cambiarEstado({{ $jinete->id_jinete }}, '{{ route('cambiarActivo', $jinete->id_jinete) }}')"
                                data-id="{{ $jinete->id_jinete }}">
                                {{ $jinete->activo ? 'Sí' : 'No' }}
                            </button>
                        </td>
                        <td><a class="btn btn-dark" href="{{ route('editarJinete', $jinete->id_jinete) }}" >Editar</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script>
    function cambiarEstado(id, url) {
        // Realizar una solicitud AJAX para cambiar el estado activo
        fetch(url, {
                method: 'PUT', // Cambiar a PUT
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
