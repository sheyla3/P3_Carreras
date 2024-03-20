<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Caballos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="navbar bg-body-tertiary" id="navbar">
        <div class="container-fluid">
            <img src="{{ asset('img/logoCaballo.png') }}" alt="caballo" id="caballoAdmin">
            <div class="float-right">
                <form method="POST" action="{{ route('admin.cerrar') }}">
                    @csrf
                    <a href="{{ route('admin.cerrar') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">Cerrar sesión</a>
                </form>
            </div>
        </div>
    </nav>

    <nav class="navbar bg-body-tertiary" id="navbar2">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('AdminCarreras') }}">Carreras</a>
            <a class="navbar-brand" href="{{ route('adminSponsors') }}">Sponsors</a>
            <a class="navbar-brand" href="{{ route('adminAseguradoras') }}">Aseguradoras</a>
        </div>
    </nav>

    <nav class="navbar bg-body-tertiary" id="navbar3">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('adminJinetes') }}">Jinetes</a>
            <a class="navbar-brand" href="{{ route('adminSocio') }}">Socios</a>
            <a class="navbar-brand" href="{{ route('adminFotos') }}">Fotos</a>
        </div>
    </nav>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
