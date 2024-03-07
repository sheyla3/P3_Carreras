<?php
use App\Http\Controllers\JineteController;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Añadir Jinete</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>

<body>
@include('layouts.cabAdmin')
<li class="float-right ml-4">
    <form action="{{ route('formularioSocio') }}" method="GET">
        @csrf
        <button type="submit" class="d-inline p-2 btn btn-primary">Añadir Socio</button>
    </form>
</li>
</body>
</html>