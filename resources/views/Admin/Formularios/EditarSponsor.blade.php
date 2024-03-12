<?php
use App\Http\Controllers\SponsorController;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Sponsor</title>
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
        <h1>Editar Sponsor</h1>
        <form action="{{ route('sponsor.editar', $sponsor->id_sponsor) }}" method="POST" enctype="multipart/form-data" class="mb-4 needs-validation">
            @csrf
            <div class="mb-3">
                <label for="cif" class="form-label">CIF:</label>
                <input type="text" id="cif" name="cif" value="{{ $sponsor->CIF ?? '' }}"
                    class="form-control">
                {!! $errors->first('cif', '<small>:message</small>') !!}
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="{{ $sponsor->nombre ?? '' }}"
                    class="form-control">
                {!! $errors->first('nombre', '<small>:message</small>') !!}
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Logo Actual:</label><br>
                @if (isset($sponsor->logo))
                    <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="Logo Actual"
                        style="max-width: 200px; max-height: 200px;">
                @else
                    <p>No hay logo disponible</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Nuevo Logo:</label>
                <input type="file" id="logo" name="logo" class="form-control" value="{{ asset($sponsor->logo) }}">
                {!! $errors->first('logo', '<small>:message</small>') !!}
            </div>
            <div class="mb-3">
                <label for="calle" class="form-label">Calle:</label>
                <input type="text" id="calle" name="calle" value="{{ $sponsor->calle ?? '' }}"
                    class="form-control">
                {!! $errors->first('calle', '<small>:message</small>') !!}
            </div>
            <div class="mb-3">
                <label for="destacado" class="form-label">Destacado:</label>
                <input type="checkbox" id="destacado" name="destacado" value="1"
                    {{ $sponsor->destacado ? 'checked' : '' }} class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <a href="{{ route('adminSponsors') }}" class="btn btn-secondary">Atrás</a>
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

</html>
