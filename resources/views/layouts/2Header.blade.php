<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .fondoheader {
            background: #1C1C1C;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <nav class="navbar bg-body-tertiary p-0">
            <div class="container-fluid" id="listaHeader">
                @if (session()->has('jinete_id') && session()->has('jinete_name'))
                    <a class="navbar-brand @if (request()->is('/')) fondoheader @endif" href="{{ route('/') }}">HOME</a>
                    <a class="navbar-brand @if (request()->is('carreras')) fondoheader @endif" href="{{ route('carreras') }}">CARRERAS</a>
                    <a class="navbar-brand @if (request()->is('record')) fondoheader @endif" href="{{ route('record') }}">RECORD</a>
                    <a class="navbar-brand @if (request()->is('tickets')) fondoheader @endif" href="{{ route('tickets') }}">TICKETS</a>
                @else
                    <a class="navbar-brand @if (request()->is('/')) fondoheader @endif" href="{{ route('/') }}">HOME</a>
                    <a class="navbar-brand @if (request()->is('record')) fondoheader @endif" href="{{ route('record') }}">RECORD</a>
                    <a class="navbar-brand @if (request()->is('tickets')) fondoheader @endif" href="{{ route('tickets') }}">TICKETS</a>
                @endif
            </div>
        </nav>
    </header>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
