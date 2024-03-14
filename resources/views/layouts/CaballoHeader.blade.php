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
    <style>
        #navbar {
            background: #1C1C1C;
            height: 40px;
            display: flex;
            flex-direction: row;
            align-items: center;
            position: absolute;
            width: 100%;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-body-tertiary p-0" id="navbar">
        <div class="p-0">
            <img src="{{ asset('img/logoCaballo.png') }}" alt="Caballo">
        </div>
        <div class="right-links">
            <a href="#" class="btn p-0" id="loginBtn">Iniciar Sesion</a>
            <a href="{{ route('loginAdmin') }}" class="btn p-0 mx-3">Registrarme</a>
        </div>
    </nav>

    <section class="Home">
        <div class="container" id="container" style="display: none;">
            <div class="form-container sign-up-container">
                <form action="{{ route('registroUsuario') }}" method="POST" id="signupForm">
                    @csrf
                    <h1>¡Quiero Ser Socio!</h1>
                    <div id="step1">
                        <input type="text" placeholder="Nombre" name="nombre" required />
                        <input type="text" placeholder="Apellido" name="apellido" required />
                        <input type="tel" placeholder="Teléfono" name="telf" required />
                        <button type="button" id="nextStep1">Next</button>
                    </div>
                    <div id="step2" style="display: none;">
                        <input type="text" placeholder="DNI" name="dni" required />
                        <input type="date" placeholder="Fecha de Nacimiento" name="edad" required />
                        <button type="button" id="prevStep2">Previous</button>
                        <button type="button" id="nextStep2">Next</button>
                    </div>
                    <div id="step3" style="display: none;">
                        <input type="email" placeholder="Correo" name="correo" required />
                        <input type="password" placeholder="Contraseña" name="contrasena" required />
                        <input type="password" placeholder="Confirmar Contraseña" name="contrasena" />
                        <input type="file" name="foto_perfil" accept="image/*" />
                        <button type="button" id="prevStep3">Previous</button>
                        <button type="submit">Sign Up</button>
                    </div>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="{{ route('loginUser') }}" method="POST">
                    @csrf
                    <h1>Iniciar Sesion</h1>
                    <input type="email" name="correo" placeholder="Enter your correo" required />
                    <input type="password" name="password" placeholder="Enter your password" required />
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
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
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

</html>
