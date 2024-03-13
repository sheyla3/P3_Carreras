<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="pie">
        <footer>
            <div class="columna">
                <div class="item">
                    <h3>Servicios</h3>
                    <ul>
                        <li><a href="#">Politica de Privacidad</a></li>
                        <li><a href="#">Cupones de Regalo</a></li>
                        <li><a href="#">Devoluciones</a></li>
                    </ul>
                </div>
                <div class="item">
                    <h3>About</h3>
                    <ul>
                        <li><a href="#">Nosotros</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                </div>
                <div class="item">
                    <h3>Empresa</h3>
                    <ul>
                        <li><a href="#">Empresa</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>
            </div>
            <div class="item social">
                <a href="https://www.facebook.com/?locale=ca_ES"><img
                        src="{{ asset('img/facebook.png') }}"alt="Facebook" width="20" height="20"></a>
                <a href="https://www.instagram.com/"><img src="{{ asset('img/instagram.png') }}" alt="Instagram"
                        width="20" height="20"></a>
                <a href="https://twitter.com/?lang=es"><img src="{{ asset('img/twitter.png') }}" alt="Twitter"
                        width="20" height="20"></a>
                <a href="https://www.pinterest.com/"><img src="{{ asset('img/pintrest.png') }}" alt="Pinterest"
                        width="20" height="20"></a>
            </div>
            <p class="copyright">© 2023 SRG Todos los derechos reservados</p>
            <p><a class="linkAdminLogin" href="{{ route('loginAdmin') }}"> Panel Administrador</a></p>

        </footer>
    </div>
    <style>
        /* Footer INICIO*/
        footer,
        .pie {
            background-color: black;
            padding-left: 1%;
            padding-top: 50px;
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
        }

        .pie {
            padding: 50px 0;
            color: white;
        }

        .pie h3 {
            margin-top: 0;
            margin-bottom: 12px;
            font-weight: bold;
            font-size: 16px;
        }

        .columna {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-left: 15%;
            margin-right: 20%;
            margin-bottom: 40px;
            text-align: center;
        }

        .pie ul {
            padding: 0;
            list-style: none;
            line-height: 1.6;
            font-size: 14px;
            margin-bottom: 0;
        }

        .pie ul a {
            color: inherit;
            text-decoration: none;
            opacity: 0.6;
        }

        .pie ul a:hover {
            opacity: 0.8;
        }

        @media (max-width:767px) {
            .pie .item:not(.social) {
                text-align: center;
                padding-bottom: 20px;
            }
        }

        .pie .item.text {
            margin-bottom: 36px;
        }

        @media (max-width:767px) {
            .pie .item.text {
                margin-bottom: 0;
            }
        }

        .pie .item.text p {
            opacity: 0.6;
            margin-bottom: 0;
        }

        .pie .item.social {
            text-align: center;
        }

        @media (max-width:991px) {
            .pie .item.social {
                text-align: center;
                margin-top: 20px;
            }
        }

        .pie .item.social>a {
            font-size: 20px;
            width: 36px;
            height: 36px;
            line-height: 36px;
            display: inline-block;
            text-align: center;
            border-radius: 50%;
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.4);
            margin: 0 8px;
            color: #fff;
            opacity: 0.75;
        }

        .pie .item.social>a:hover {
            opacity: 0.9;
        }

        .pie .copyright {
            text-align: center;
            padding-top: 24px;
            opacity: 0.3;
            font-size: 13px;
            margin-bottom: 0;
        }

        /* Footer FIN*/
    </style>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
