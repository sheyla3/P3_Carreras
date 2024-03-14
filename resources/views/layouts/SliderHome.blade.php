<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    <style>
        .header-slider-container {
            position: relative;
            width: 100%;
            z-index: -1;
            height: auto;
            padding-top: 40px;
        }

        #carouselExampleIndicators {
            width: 100%;
        }

        .header-container {
            position: absolute;
            width: 100%;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="header-container">
        @include('layouts.2Header')
    </div>

    <div class="header-slider-container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('img/banner.png') }}" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <button type="button" class="btn mx-3" style="background:#D9D9D9;color:black;">READ
                            MORE</button>
                        <button type="button" class="btn mx-3" style="background: #1F323F;color:white;">GET A
                            QUOTE</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('img/banner1.jpg') }}" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <button type="button" class="btn mx-3" style="background:#D9D9D9;color:black;">READ
                            MORE</button>
                        <button type="button" class="btn mx-3" style="background: #1F323F;color:white;">GET A
                            QUOTE</button>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('img/banner.png') }}" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <button type="button" class="btn mx-3" style="background:#D9D9D9;color:black;">READ
                            MORE</button>
                        <button type="button" class="btn mx-3" style="background: #1F323F;color:white;">GET A
                            QUOTE</button>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
