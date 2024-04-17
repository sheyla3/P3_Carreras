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
</head>

<body>
    @if (isset($socioId) && isset($socioName))
        @include('layouts.CHSocio')
    @elseif (isset($jineteId) && isset($jineteName))
        @include('layouts.CHJinete')
    @else
        @include('layouts.CaballoHeader')
    @endif
    <div class="enlacesHeader">
        <h1 class="float-left tituloHeader2">Buscar</h1>
        @include('layouts.2Header')
    </div>
    <div class="buscador">
        <form method="POST" action="{{ route('buscarCarreras') }}">
            @csrf
            <input type="search" name="BcarreraHome" id="">
        </form>
    </div>
    <div class="contenedor-tickets">
        @foreach ($carreras as $carrera)
            <div class="carrera">
                <div class="carrera-img">
                    <img src="{{ asset('storage/' . $carrera->cartel) }}" width="378px" height="342px"
                        alt="{{ $carrera->nombre }}">
                </div>
                <div class="datos">
                    <div id="datos-title">
                        <h2 class="text-break">{{ $carrera->nombre }}</h2>
                    </div>
                    <div>
                        <p class="text-break">{{ $carrera->descripcion }}</p>
                    </div>
                    <div>
                        <p class="text-break">{{ \Carbon\Carbon::parse($carrera->fechaHora)->format('d-m-Y - H:i') }}
                        </p>
                    </div>
                    <div>
                        <h3 class="text-break">{{ $carrera->precio }} €</h3>
                    </div>
                </div>
                @if ($carrera->esAntigua)
                    <div class="clasificacion">
                        <a href="{{ route('carreraAntigua', $carrera->id_carrera) }}"><button>Ver
                                clasificacion</button></a>
                    </div>
                @else
                    <div class="clasificacion">
                        <button class="buy-btn" data-title="{{ $carrera->nombre }}"
                            data-description="{{ $carrera->descripcion }}" data-id="{{ $carrera->id }}"
                            data-price="{{ $carrera->precio }}">Comprar</button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    @if (session('ERROR'))
        <div class="modal" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ session('ERROR') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#errorModal').modal('show');
            });
        </script>
    @endif
</body>
@include('layouts.footer')

</html>
