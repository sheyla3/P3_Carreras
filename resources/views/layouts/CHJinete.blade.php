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
            z-index: 999;
        }

        .dropdown-menu {
            color: #ffffff;
        }

        .dropdown-menu button {
            color: #ffffff;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-body-tertiary p-0" id="navbar">
        <div class="p-0">
            <a href="{{ route('/') }}"><img src="{{ asset('img/logoCaballo.png') }}" alt="Caballo"></a>
        </div>
        <div class="right-links">
            <div class="dropdown show">
                <button type="button" class="dropdown-toggle btn p-0 mr-1" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <img src="{{ asset('img/menu.svg') }}" alt="menu" height="30" width="30">
                </button>
                <div class="dropdown-menu dropdown-menu-right" style="background-color: #1C1C1C">
                    @if (session()->has('jinete_id') && session()->has('jinete_name'))
                        <button class="dropdown-item" type="button">
                            <a href="{{ route('perfil.mostrar', ['id' => session('jinete_id')]) }}" class="p-1">Perfil</a>
                        </button>
                        <button class="dropdown-item" type="button">
                            <a href="{{ route('misCarreras', ['id' => session('jinete_id')]) }}" class="p-1">Mis carreras</a>
                        </button>
                    @endif
                    <button class="dropdown-item" type="button">
                        <a href="{{ route('buscarJinete') }}" class="p-1">Buscar Carrera</a>
                    </button>
                    <form method="POST" action="{{ route('admin.cerrar') }}">
                        @csrf
                        <a href="{{ route('admin.cerrar') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();" class="p-1 ml-4">Cerrar sesión</a>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
        $('.dropdown-toggle').dropdown()
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<script>
    $('.dropdown-toggle').dropdown()
</script>

</html>
