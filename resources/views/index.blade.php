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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<style>
.Maestro-2 .slider-container {
    overflow: hidden;
    position: relative;
    width: 100%;
    display: flex; /* Añadir display flex para centrar los slides */
    justify-content: center; /* Centrar los slides horizontalmente */
}
.Maestro-2 .slider {
    display: flex;
    transition: transform 0.5s ease;
}

.Maestro-2 .slide {
    margin-top: 10px;
    margin-left: 5%;
    flex: 0% 0 100%; /* Cada slide ocupa el 100% del contenedor */
    display: flex;
}

.Maestro-2 .carrera {
    flex: 0 0 30%; /* Cada carrera ocupa 1/4 del ancho del slide */
    max-width: 30%;
    padding: 0 0;
    box-sizing: border-box;
    position: relative; /* Añadir posición relativa */
}

.Maestro-2 .carrera img {
    width: 100%; /* Ajustar el ancho de la imagen al 100% */
    height: auto; /* Mantener la proporción */
}

.Maestro-2 .carrera h3 {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    width: 100%;
    height: 400px;
    bottom: 0px;
    left: 0;
    right: 0;
    text-align: center;
    margin: 0;
    color: #fff;
    background-color: rgba(0, 0, 0, 0.5);
    padding: 5px;
}
.Maestro-2 .prev-btn,
.Maestro-2 .next-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(255, 255, 255, 0.5);
    border: none;
    cursor: pointer;
    padding: 10px;
    z-index: 1;
}

.Maestro-2 .prev-btn {
    left: 0;
}

.Maestro-2 .next-btn {
    right: 0;
}

</style>


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
    <div class="Maestro-1 d-flex justify-content-center">
        <div class="container-1">
            <img src="{{ asset('img/horseblack.png') }}" alt="">
        </div>
        <div class="container-2">
            <h1>¡Caballos en acción! ¡Compra ya!</h1>
            <svg width="95" height="26" viewBox="0 0 95 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="94.2" height="25.7073" rx="12.8537" fill="#1F323F" />
            </svg>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero exercitationem consequatur voluptatem
                soluta reprehenderit repudiandae eveniet explicabo reiciendis. Praesentium quia explicabo maiores
                accusamus nostrum ex fugiat quaerat! Suscipit maxime eaque adipisci reprehenderit quos natus!</p>
            <button href="{{ route('tickets') }}" type="button" class="btn btn-primary"
                style="background:#1F323F; width: 20%">READ MORE</button>
        </div>
    </div>

    <nav class="navbar bg-body-tertiary" id="Lugares">
        <div class="container-fluid">
            <h1>LAS MEJORES CARRERAS EN LAS MEJORES CIUDADES!</h1>
        </div>
    </nav>
    <div class="Maestro-2">
        <div class="slider-container">
            <div class="slider">
                @foreach ($carreras->chunk(3) as $chunk)
                    <div class="slide">
                        @foreach ($chunk as $carrera)
                            <div class="carrera">
                                <img src="{{ asset('storage/' . $carrera->lugar_foto) }}" alt="Lugar de {{ $carrera->nombre }}" class="img-fluid">
                                <h3>{{ $carrera->nombre }}</h3>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
            <button class="prev-btn">&#10094;</button>
            <button class="next-btn">&#10095;</button>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#carouselExampleInterval').slick({
                slidesToShow: 3, // Número de carreras a mostrar simultáneamente
                slidesToScroll: 1, // Número de carreras a avanzar
                autoplay: true, // Habilita el autoplay
                autoplaySpeed: 2000, // Velocidad del autoplay en milisegundos
                prevArrow: $('.carousel-control-prev'), // Selector del botón previo
                nextArrow: $('.carousel-control-next'), // Selector del botón siguiente
                responsive: [{
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
            <img src="{{ asset('img/master3.png') }}" alt="caballo">
        </div>
    </div>
    <div class="Maestro-4 mb-5">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
        <div class="container">
            <div class="text-center my-3">
                <h2>Sponsors</h2>
            </div>
            @if ($sponsorsDestacados->isEmpty())
                <p class="text-center">De momento no hay sponsors destacados</p>
            @else
                <section class="sponsors-home slider">
                    @foreach ($sponsorsDestacados as $sponsor)
                        <div class="slide">
                            <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->nombre }}"
                                height="100" class="px-2 w-100">
                        </div>
                    @endforeach
                </section>
            @endif
        </div>
    </div>
</body>
@include('layouts.footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- Slick Carousel JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

<script>
    $(document).ready(function() {
        $('#carouselExampleInterval').slick({
            slidesToShow: 3, // Número de carreras a mostrar simultáneamente
            slidesToScroll: 1, // Número de carreras a avanzar
            autoplay: true, // Habilita el autoplay
            autoplaySpeed: 5000, // Velocidad del autoplay en milisegundos
            prevArrow: '<span class="carousel-control-prev-icon" aria-hidden="true"></span>',
            nextArrow: '<span class="carousel-control-next-icon" aria-hidden="true"></span>',
            responsive: [{
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
    // CARUSEL SPONSORS
    $(document).ready(function() {
        $('.sponsors-home').slick({
            slidesToShow: 6,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            arrows: false,
            dots: false,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 4
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 3
                }
            }]
        });
    });


    // MAestro 2

    $(document).ready(function() {
    var slider = $(".Maestro-2 .slider");
    var sliderWidth = $(".Maestro-2 .slider").width();
    var slideIndex = 0;

    $(".Maestro-2 .prev-btn").click(function() {
        if (slideIndex > 0) {
            slideIndex--;
            slider.css("transform", "translateX(-" + (slideIndex * sliderWidth) + "px)");
        }
    });

    $(".Maestro-2 .next-btn").click(function() {
        if (slideIndex < $(".Maestro-2 .slide").length - 1) {
            slideIndex++;
            slider.css("transform", "translateX(-" + (slideIndex * sliderWidth) + "px)");
        }
    });
});

</script>

</html>
