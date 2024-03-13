<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

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
                <a class="navbar-brand @if(request()->is('/')) bg-dark @endif" href="{{ route('/') }}">HOME</a>
                <a class="navbar-brand @if(request()->is('carreras')) bg-dark @endif" href="#">CARRERAS</a>
                <a class="navbar-brand @if(request()->is('record')) bg-dark @endif" href="#">RECORD</a>
                <a class="navbar-brand @if(request()->is('tickets')) bg-dark @endif" href="{{ route('tickets') }}">TICKETS</a>
            </div>
        </nav>        
        <button type="button" class="btn btn-primary">READ MORE</button>
        <button type="button" class="btn btn-primary">GET A QUOTE</button>
    </header>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
