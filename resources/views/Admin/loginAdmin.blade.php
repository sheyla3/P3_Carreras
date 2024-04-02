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
@include('layouts.CaballoHeader')

<body class="FondoAdmin">
    <div class="ImgAdmin">
        <div class="row w-100 d-flex justify-content-center">
            <div class="w-25">
                <div class="card w-100 shadow-lg rounded text-white bg-dark mb-3 text-center">
                    <div class="card-header">ADMIN</div>
                    <div class="card-body">
                        <h5 class="card-title">BIENVENIDO!</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Pon tu usuario y contraseña:</h6>
                        <form action="{{ route('admin.iniciar') }}" method="POST">
                            @csrf
                            <input type="text" id="usuario" name="usuario" value="{{ old('usuario') }}" placeholder="Usuario" class="form-control rounded-0">
                            <p>{!! $errors->first('usuario', '<small>:message</small>') !!}</p>
                            <input type="password" id="contra" name="contra" value="{{ old('contra') }}" placeholder="Contraseña" class="form-control rounded-0">
                            <p>{!! $errors->first('contra', '<small>:message</small>') !!}</p>
                            <input type="submit" value="Iniciar" class="btn btn-iniciar text-white">
                        </form>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="{{ route('/') }}">Home</a>
                    </div>
                </div>
            </div>
        </div>
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
@include('layouts.footer')

</html>
