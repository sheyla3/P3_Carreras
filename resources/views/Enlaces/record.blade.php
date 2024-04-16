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
        <h1 class="float-left tituloHeader2">Record</h1>
        @include('layouts.2Header')
    </div>
    <div class="contenedor-tickets">
        @foreach ($carreras as $carrera)
            <div class="carrera">
                <div class="carrera-img">
                    <img src="{{ asset('storage/' . $carrera->lugar_foto) }}" width="378px" height="342px"
                        alt="{{ $carrera->nombre }}">
                </div>

                <div class="datos">
                    <div id="datos-title">
                        <h3>{{ $carrera->nombre }}</h3>
                    </div>
                    <div>
                        <p>{{ $carrera->descripcion }}</p>
                    </div>
                    <div>
                        <p>{{ $carrera->tipo }} de {{ $carrera->km }}km</p>
                    </div>
                    <div>
                        <p class="text-break">{{ \Carbon\Carbon::parse($carrera->fechaHora)->format('d-m-Y - H:i') }}</p>
                    </div>
                </div>

                <div class="clasificacion">
                    <a href="{{ route('carreraAntigua', $carrera->id_carrera) }}"><button>Ver clasificacion</button></a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="my-3">
        <nav aria-label="Page navigation" class="paginacion text-dark">
            <ul class="pagination justify-content-center pagination-sm">
                @if ($carreras->lastPage() > 1)
                    @for ($i = 1; $i <= $carreras->lastPage(); $i++)
                        <li class="page-item {{ $carreras->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $carreras->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                @endif
            </ul>
        </nav>
        <div class="text-center">
            {{ $carreras->firstItem() }} / {{ $carreras->lastItem() }} de {{ $carreras->total() }} carreras
        </div>
    </div>
</body>
@include('layouts.footer')
</html>
