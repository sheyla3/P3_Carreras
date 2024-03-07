<?php
use App\Http\Controllers\JineteController;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Jinete</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>

<body class="FondoAdmin">
    @include('layouts.cabAdmin')
    <div class="container">
        <h1>Editar Jinete</h1>
        <form action="{{ route('jinete.editar', $jinete->id_jinete) }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ $jinete->nombre ?? '' }}" class="form-control">
                {!! $errors->first('nombre', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" id="apellido" name="apellido" value="{{ $jinete->apellido ?? '' }}" class="form-control">
                {!! $errors->first('apellido', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Email:</label>
                <input type="text" id="correo" name="correo" value="{{ $jinete->correo ?? '' }}" class="form-control">
                {!! $errors->first('correo', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="mb-3">
                <label for="contra" class="form-label">Contraseña:</label>
                <input type="text" id="contra" name="contra" value="{{ $jinete->contrasena ?? '' }}" class="form-control">
                {!! $errors->first('contra', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="mb-3">
                <label for="telf" class="form-label">Teléfono:</label>
                <input type="text" id="telf" name="telf" value="{{ $jinete->telf ?? '' }}" class="form-control">
                {!! $errors->first('telf', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="mb-3">
                <label for="calle" class="form-label">Calle:</label>
                <input type="text" id="calle" name="calle" value="{{ $jinete->calle ?? '' }}" class="form-control">
                {!! $errors->first('calle', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="mb-3">
                <label for="num_fede" class="form-label">Número de federación:</label>
                <input type="text" id="num_fede" name="num_fede" value="{{ $jinete->num_federat ?? '' }}" class="form-control">
                {!! $errors->first('num_fede', '<small class="text-danger">:message</small>') !!}
            </div>
            <div class="mb-3">
                <label for="edad" class="form-label">Edad:</label>
                <input type="text" id="edad" name="edad" value="{{ $jinete->formatted_edad ?? '' }}" class="form-control">
                {!! $errors->first('edad', '<small class="text-danger">:message</small>') !!}
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <a href="{{ route('adminJinetes') }}" class="btn btn-secondary">Atrás</a>
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
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>