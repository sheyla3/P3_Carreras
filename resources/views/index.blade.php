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
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
</head>
<body>
<nav class="navbar bg-body-tertiary" id="navbar">
    <div class="container-fluid">
        <img src="{{ asset('img/logoCaballo.png') }}" alt="">
    </div>
    <div class="right-links">
        <a href="{{ route('loginAdmin') }}" class="btn btn-primary">Iniciar Sesion</a>
        <a href="{{ route('loginAdmin') }}" class="btn btn-primary">Registrarme</a>
    </div>
</nav>

<header>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid" id="listaHeader">
            <a class="navbar-brand" href="#">HOME</a>
            <a class="navbar-brand" href="#">CARRITO</a>
            <a class="navbar-brand" href="#">RECORD</a>
            <a class="navbar-brand" href="{{ route('tickets') }}">TICKETS</a>
        </div>
    </nav>

    <button type="button" class="btn btn-primary" style="background:white;">READ MORE</button>
    <button type="button" class="btn btn-primary">GET A QUOTE</button>
</header>

    <section class="Home">
        <div class="form_container">
            <i class="uil uil-times form_close"></i>
            <!-- Login form -->
            <div class="form login_form">
                <form action="{{ route('loginUser') }}">
                    <h2>Login</h2>
                    <div class="input_box">
                        <!-- sera un email -->
                        <input type="email" placeholder="Enter your email" required/>  
                        <i class="uil uil-envelope-alt email"></i>
                    </div>
                    <div class="input_box">
                        <input type="password" placeholder="Enter your password" required/>
                        <i class="uil uil-lock password"></i>
                        <i class="uil uil-eye-slash pw_hide"></i>
                    </div>
                    <input type="submit" value="Iniciar">
                </form>
            </div>
        </div>
    </section>


<div class="Maestro-1">
    <div class="container-1">
        <img src="{{ asset('img/horseblack.png') }}" alt="">
    </div>
    <div class="container-2">
        <h1>Lorem ipsum dolor sit.</h1>
        <svg width="95" height="26" viewBox="0 0 95 26" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="94.2" height="25.7073" rx="12.8537" fill="#1F323F"/>
        </svg>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero exercitationem consequatur voluptatem soluta reprehenderit repudiandae eveniet explicabo reiciendis. Praesentium quia explicabo maiores accusamus nostrum ex fugiat quaerat! Suscipit maxime eaque adipisci reprehenderit quos natus!</p>
        <button type="button" class="btn btn-primary" style="background:white;">READ MORE</button>
    </div>
</div>

    <nav class="navbar bg-body-tertiary" id="Lugares">
        <div class="container-fluid">
            <h1>LAS MEJORES CARRERAS EN LAS MEJORES CIUDADES!</h1>
        </div>
    </nav>

    <div class="Maestro-2">
        <p>Aqui iran los lugares de la base de datos</p>
    </div>

    <div class="Maestro-3">
        <div class="container-4">
            <h1>COMPETIR JUGAR Y DISFRUTAR</h1>
            <p>Apuntate a la proxima carrera el proximo 10 de marzo de 2024, todavia quedan plazas, no te lo pierdas...</p>
        </div>
        <div class="container-3">
            <img src="{{ asset('img/master3.png') }}" alt="">
        </div>
    </div>
<!-- <a class="linkAdminLogin" href="{{ route('loginAdmin') }}"> Panel Administrador</a> -->
</body>
</html>
