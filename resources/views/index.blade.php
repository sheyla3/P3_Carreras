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
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('node_modules/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('node_modules/slick-carousel/slick/slick-theme.css') }}">
    <script src="{{ asset('node_modules/slick-carousel/slick/slick.min.js') }}"></script>
</head>

<body>
    @if (isset($socioId) && isset($socioName))
        @include('layouts.CHSocio')
    @elseif (isset($jineteId) && isset($jineteName))
        @include('layouts.CHJinete')
    @else
        @include('layouts.CaballoHeader')
    @endif

    @include('layouts.SliderHome')

    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat:400,800');
    </style>
    <div class="Maestro-1">
        <div class="container-1">
            <img src="{{ asset('img/horseblack.png') }}" alt="">
        </div>
        <div class="container-2">
            <h1>Lorem ipsum dolor sit.</h1>
            <svg width="95" height="26" viewBox="0 0 95 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="94.2" height="25.7073" rx="12.8537" fill="#1F323F" />
            </svg>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero exercitationem consequatur voluptatem
                soluta reprehenderit repudiandae eveniet explicabo reiciendis. Praesentium quia explicabo maiores
                accusamus nostrum ex fugiat quaerat! Suscipit maxime eaque adipisci reprehenderit quos natus!</p>
            <button type="button" class="btn btn-primary" style="background:#1F323F; width: 20%">READ MORE</button>
        </div>
    </div>

    <nav class="navbar bg-body-tertiary" id="Lugares">
        <div class="container-fluid">
            <h1>LAS MEJORES CARRERAS EN LAS MEJORES CIUDADES!</h1>
        </div>
    </nav>

    <div class="Maestro-2">
    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach($carreras->chunk(3) as $chunk)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <div class="row">
                    @foreach($chunk as $carrera)
                        <div class="col">
                            <div class="lugares">
                                <img src="{{ asset('storage/'.$carrera->lugar_foto) }}" alt="Lugar de {{ $carrera->nombre }}">
                                <h3>{{ $carrera->nombre }}</h3>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
    </div>

    <script>$(document).ready(function(){
    $('#carouselExampleInterval').slick({
        slidesToShow: 3, // Número de carreras a mostrar simultáneamente
        slidesToScroll: 1, // Número de carreras a avanzar
        autoplay: true, // Habilita el autoplay
        autoplaySpeed: 2000, // Velocidad del autoplay en milisegundos
        prevArrow: $('.carousel-control-prev'), // Selector del botón previo
        nextArrow: $('.carousel-control-next'), // Selector del botón siguiente
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2 // Cambia el número de carreras mostradas en dispositivos de tamaño medio
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1 // Cambia el número de carreras mostradas en dispositivos pequeños
                }
            }
        ]
    });
});
</script>

    <div class="Maestro-3">
        <div class="container-4">
            <h1>COMPETIR JUGAR Y DISFRUTAR</h1>
            <p>Apuntate a la proxima carrera el proximo 10 de marzo de 2024, todavia quedan plazas, no te lo pierdas...
            </p>
        </div>
        <div class="container-3">
            <img src="{{ asset('img/master3.png') }}" alt="">
        </div>
    </div>
    <!-- <a class="linkAdminLogin" href="{{ route('loginAdmin') }}"> Panel Administrador</a> -->
</body>
@include('layouts.footer')

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Slick Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script>
    $(document).ready(function(){
        $('#carouselExampleInterval').slick({
            slidesToShow: 3, // Número de carreras a mostrar simultáneamente
            slidesToScroll: 1, // Número de carreras a avanzar
            autoplay: true, // Habilita el autoplay
            autoplaySpeed: 5000, // Velocidad del autoplay en milisegundos
            prevArrow: '<span class="carousel-control-prev-icon" aria-hidden="true"></span>',
            nextArrow: '<span class="carousel-control-next-icon" aria-hidden="true"></span>',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2 // Cambia el número de carreras mostradas en dispositivos de tamaño medio
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 1 // Cambia el número de carreras mostradas en dispositivos pequeños
                    }
                }
            ]
        });
    });
</script>
</html>
