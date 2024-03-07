<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AseguradoraController;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>

<body class="FondoAdmin">
    <div class="ImgAdmin">
        <h1>Login Admin</h1>
        <form action="{{ route('admin.iniciar') }}" method="POST">
            @csrf
            <label for="usuario">Usuario:</label><br>
            <input type="text" id="usuario" name="usuario" value="{{ old('usuario') }}" placeholder="Usuario"><br>
            {!! $errors->first('usuario', '<small>:message</small>') !!}<br>
            <label for="contra">Contraseña:</label><br>
            <input type="password" id="contra" name="contra" value="{{ old('contra') }}"
                placeholder="Contraseña"><br>
            {!! $errors->first('contra', '<small>:message</small>') !!}<br><br>
            <input type="submit" value="Iniciar">
        </form>
        <a href="{{ route('/') }}">Home</a>
    </div>
    @if (session('ERROR'))
        <div class="modal" id="errormodal" tabindex="-1" role="dialog" aria-labelledby="errormodalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errormodalLabel">ERROR</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ session('ERROR') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#errormodal').modal('show');
            });
        </script>
    @endif
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
