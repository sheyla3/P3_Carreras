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
            z-index: 9999;
            /* Asegura que el navbar esté por encima de todo */
        }

        /* Estilos para el formulario de jinetes */
        #container2 {
            position: fixed;
            width: 50%;
            height: 480px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 99999;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 10px 5px 10px rgb(0 0 0 / 25%);
        }

        #step1 {
            margin-top: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            display: flex;
            flex-direction: column;
        }

        #step1 input {
            background-color: #eee;
            border: none;
            padding: 12px 15px;
            margin: 8px 0;
            width: 100%;
        }

        #step1 button {
            border-radius: 20px;
            border: 1px solid #13212B;
            background-color: #13212B;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            margin: 12px;
        }


        #step1 h1 {
            font-weight: bold;
            margin: 0;
        }

        /* Estilos para los botones del formulario de jinetes */
        #container2 button {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-body-tertiary p-0" id="navbar">
        <div class="p-0" tabindex="1">
            <a href="{{ route('/') }}"><img src="{{ asset('img/logoCaballo.png') }}" alt="Caballo"></a>
        </div>
        <div class="right-links" tabindex="2">
            <a href="#" class="btn p-0 mr-4" id="loginBtn" tabindex="3">Socio</a>
            <a href="#" class="btn p-0 mr-3" id="JineteBtn" tabindex="4">Jinete</a>
            <a href="{{ route('buscarHome') }}" class="p-0 mr-3" tabindex="5"><img src="{{ asset('img/lupa-blanca.svg') }}" alt="buscar" width="20" height="20"></a>
        </div>
    </nav>

    <section class="Home">
        <div class="container" id="container" style="display: none;">
            <div class="form-container sign-up-container">
                <form action="{{ route('registroUsuario') }}" method="POST" id="signupForm">
                    @csrf
                    <h1>¡Quiero Ser Socio!</h1>
                    <div id="step1">
                        <input type="text" placeholder="Nombre" name="nombre" pattern="^[a-zA-Z]+$" required
                            title="El nombre no puede contener espacios ni caracteres especiales" tabindex="6"/>
                        <input type="text" placeholder="Apellido" name="apellido" pattern="^[a-zA-Z]+$" required
                            title="El apellido no puede contener espacios ni caracteres especiales" tabindex="7"/>
                        <input type="tel" placeholder="Teléfono" name="telf" pattern="^\d{9}$" required
                            title="El teléfono debe tener 9 dígitos" tabindex="8"/>
                        <button type="button" id="nextStep1" tabindex="9">siguiente</button>
                    </div>
                    <div id="step2" style="display: none;">
                        <input type="text" placeholder="DNI" name="dni" pattern="^\d{8}[A-Za-z]$" required
                            title="Formato de DNI incorrecto" tabindex="10"/>
                        <input type="date" placeholder="Fecha de Nacimiento" name="edad" id="edad" required
                            max="{{ date('Y-m-d') }}" title="La fecha de nacimiento no puede ser posterior a hoy" tabindex="11"/>
                        <script>
                            function validarFecha() {
                                var fechaNacimiento = document.getElementById("edad").value;
                                var fechaActual = new Date();
                                var fechaLimite = new Date(fechaActual.getFullYear() - 18, fechaActual.getMonth(), fechaActual.getDate());
                                if (new Date(fechaNacimiento) > fechaLimite) {
                                    alert("Debes ser mayor de edad para registrarte.");
                                    return false;
                                }
                                return true;
                            }
                        </script>
                        <button type="button" id="prevStep2" tabindex="12">anterior</button>
                        <button type="button" id="nextStep2" tabindex="13">siguiente</button>
                    </div>
                    <div id="step3" style="display: none;">
                        <input type="email" placeholder="Correo" name="correo" pattern="^\S+@\S+\.\S+$" required
                            title="Formato de correo electrónico incorrecto" tabindex="14"/>
                        <input type="password" placeholder="Contraseña" name="contrasena" required
                            title="La contraseña no puede estar vacía" tabindex="15"/>
                        <input type="password" placeholder="Confirmar Contraseña" name="contrasena_confirmacion"
                            required title="La contraseña de confirmación no puede estar vacía" tabindex="16"/>
                        <button type="button" id="prevStep3" tabindex="17">anterior</button>
                        <button type="submit" tabindex="18">Registrar</button>
                    </div>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="{{ route('loginUser') }}" method="POST">
                    @csrf
                    <h1>Iniciar Sesion</h1>
                    <input type="email" name="correo" placeholder="Correo" tabindex="19" required />
                    <input type="password" name="password" placeholder="Contraseña" tabindex="20" required />
                    <a href="#" tabindex="21">Has olvidado tu contraseña?</a>
                    <button type="submit" tabindex="22">Entrar</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Bienvenido de vuelta socio!</h1>
                        <p>Conectate y visualiza todas las novedades.</p>
                        <button class="ghost" id="signIn" tabindex="23">Entrar</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hola Futuro Socio!</h1>
                        <p>Registrate para ver las mejores carreras de caballos!</p>
                        <button class="ghost" id="signUp" tabindex="24">Registrarme</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="HomeJinete">
    <div class="container" id="container2" style="display: none;">
        <div class="form-container sign-up-container">
            <form action="{{ route('jinete.nuevo') }}" method="POST" id="signupFormJinete" enctype="multipart/form-data">
                @csrf
                <h1>¡Quiero Ser Jinete!</h1>
                <div id="step1Jinete">
                    <input type="text" placeholder="Nombre" name="nombre" pattern="^[a-zA-Z]+$" required title="El nombre no puede contener espacios ni caracteres especiales"/>
                    <input type="text" placeholder="Apellido" name="apellido" pattern="^[a-zA-Z]+$" required title="El apellido no puede contener espacios ni caracteres especiales"/>
                    <input type="email" placeholder="Correo" name="correo" pattern="^\S+@\S+\.\S+$" required title="Formato de correo electrónico incorrecto"/>
                    <button type="button" id="nextStep1Jinete">siguiente</button>
                </div>
                <div id="step2Jinete" style="display: none;">
                    <input type="text" placeholder="Nº FEDERACIÓN" name="num_fede" required title="Numero de federación invalido"/>
                    <input type="password" placeholder="Contraseña" name="contra" required title="La contraseña no puede estar vacía"/>
                    <input type="password" placeholder="Confirmar Contraseña" name="contra_confirmacion" required title="La contraseña de confirmación no puede estar vacía"/>
                    <button type="button" id="prevStep2Jinete">anterior</button>
                    <button type="button" id="nextStep2Jinete">siguiente</button>
                </div>
                <div id="step3Jinete" style="display: none;">
                    <input type="file" placeholder="Foto" name="foto"/>
                    <input type="text" placeholder="Dirección" name="calle"/>
                    <input type="text" placeholder="Telefono" name="telf"/>
                    <input type="date" placeholder="Fecha de Nacimiento" name="edad" id="edadJinete" required max="{{ date('Y-m-d') }}" title="La fecha de nacimiento no puede ser posterior a hoy" />
                    <script>
                        function validarFechaJinete() {
                            var fechaNacimiento = document.getElementById("edadJinete").value;
                            var fechaActual = new Date();
                            var fechaLimite = new Date(fechaActual.getFullYear() - 18, fechaActual.getMonth(), fechaActual.getDate());
                            if (new Date(fechaNacimiento) > fechaLimite) {
                                alert("Debes ser mayor de edad para registrarte.");
                                return false;
                            }
                            return true;
                        }
                    </script>
                    <button type="button" id="prevStep3Jinete">anterior</button>
                    <button type="submit">Entrar</button>
                </div>
            </form>                
        </div>
            <div class="form-container sign-in-container">
                <form action="{{ route('loginJinete') }}" method="POST">
                    @csrf
                    <h1>Iniciar Sesion</h1>
                    <input type="email" name="correo" placeholder="Correo" required />
                    <input type="password" name="password" placeholder="Contraseña" required />
                    <a href="#">Has olvidado tu contraseña?</a>
                    <button type="submit">Entrar</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Bienvenido de nuevo!</h1>
                        <p>Inicia Sesión y actualiza tu información</p>
                        <button class="ghost" id="signIn2">Entrar</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>¿Quieres ser un Jinete?</h1>
                        <p>Registarte y participa en la proxima carrera.</p>
                        <button class="ghost" id="signUp2">Registrarme</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


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

<script>
    const JineteBtn = document.getElementById('JineteBtn');
    const container2 = document.getElementById('container2');

    JineteBtn.addEventListener('click', () => {
        container2.style.display = 'block';
    });

    document.addEventListener('click', (e) => {
        if (!container2.contains(e.target) && e.target !== JineteBtn) {
            container2.style.display = 'none';
        }
    });

    const signUp2Button = document.getElementById('signUp2');
    const signIn2Button = document.getElementById('signIn2');

    signUp2Button.addEventListener('click', () => {
        container2.classList.add("right-panel-active");
    });

    signIn2Button.addEventListener('click', () => {
        container2.classList.remove("right-panel-active");
    });

    const signupFormJinete = document.getElementById('signupFormJinete');
    const step1Jinete = document.getElementById('step1Jinete');
    const step2Jinete = document.getElementById('step2Jinete');
    const step3Jinete = document.getElementById('step3Jinete');
    const nextStep1Jinete = document.getElementById('nextStep1Jinete');
    const nextStep2Jinete = document.getElementById('nextStep2Jinete');
    const prevStep2Jinete = document.getElementById('prevStep2Jinete');
    const prevStep3Jinete = document.getElementById('prevStep3Jinete');

    nextStep1Jinete.addEventListener('click', () => {
        step1Jinete.style.display = 'none';
        step2Jinete.style.display = 'block';
    });

    nextStep2Jinete.addEventListener('click', () => {
        step2Jinete.style.display = 'none';
        step3Jinete.style.display = 'block';
    });

    prevStep2Jinete.addEventListener('click', () => {
        step2Jinete.style.display = 'none';
        step1Jinete.style.display = 'block';
    });

    prevStep3Jinete.addEventListener('click', () => {
        step3Jinete.style.display = 'none';
        step2Jinete.style.display = 'block';
    });
</script>
</html>