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
        <a href="#" class="btn btn-primary" id="loginBtn">Iniciar Sesion</a>
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

<style>
    
@import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');


</style>
    <section class="Home">
        <div class="container" id="container" style="display: none;">
            <div class="form-container sign-up-container">
                <form action="{{ route('registroUsuario') }}" method="POST" id="signupForm">
                @csrf
                <h1>Create Account</h1>
                <div id="step1">
                    <input type="text" placeholder="Nombre" name="nombre" required/>
                    <input type="text" placeholder="Apellido" name="apellido" required/>
                    <input type="tel" placeholder="Teléfono" name="telf" required/>
                    <button type="button" id="nextStep1">Next</button>
                </div>
                <div id="step2" style="display: none;">
                    <input type="text" placeholder="DNI" name="dni" required/>
                    <input type="date" placeholder="Fecha de Nacimiento" name="edad" required/>
                    <button type="button" id="prevStep2">Previous</button>
                    <button type="button" id="nextStep2">Next</button>
                </div>
                <div id="step3" style="display: none;">
                    <input type="email" placeholder="Correo" name="correo" required/>
                    <input type="password" placeholder="Contraseña" name="contrasena" required/>
                    <input type="password" placeholder="Confirmar Contraseña" name="contrasena"/>
                    <input type="file" name="foto_perfil" accept="image/*"/>
                    <button type="button" id="prevStep3">Previous</button>
                    <button type="submit">Sign Up</button>
                </div>
            </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="{{ route('loginUser') }}" method="POST">
                @csrf
                    <h1>Sign in</h1>
                    <input type="email" name="correo" placeholder="Enter your correo" required/>  
                    <input type="password" name="password" placeholder="Enter your password" required/>
                    <a href="#">Forgot your password?</a>
                    <button>Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    const loginBtn = document.getElementById('loginBtn');
    const container = document.getElementById('container');

    loginBtn.addEventListener('click', () => {
        container.style.display = 'block';
    });

    document.addEventListener('click', (e) => {
        if (!container.contains(e.target) && e.target !== loginBtn) {
            container.style.display = 'none';
        }
    });

    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>

<script>
    const signupForm = document.getElementById('signupForm');
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    const nextStep1 = document.getElementById('nextStep1');
    const nextStep2 = document.getElementById('nextStep2');
    const prevStep2 = document.getElementById('prevStep2');
    const prevStep3 = document.getElementById('prevStep3');

    nextStep1.addEventListener('click', () => {
        step1.style.display = 'none';
        step2.style.display = 'block';
    });

    nextStep2.addEventListener('click', () => {
        step2.style.display = 'none';
        step3.style.display = 'block';
    });

    prevStep2.addEventListener('click', () => {
        step2.style.display = 'none';
        step1.style.display = 'block';
    });

    prevStep3.addEventListener('click', () => {
        step3.style.display = 'none';
        step2.style.display = 'block';
    });
</script>
    


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
