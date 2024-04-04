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
    <style>
        #slider {
            margin: 0 auto;
            width: 800px;
            height: 500px;
            overflow: hidden;
            background-color: black;
        }

        /*Valores de las imagenes*/
        #slider img {
            margin: 0 auto;
            -moz-transition: opacity 2s;
            -webkit-transition: opacity 2s;
            transition: opacity 2s;
            width: 800px;
            height: 500px;
            position: absolute;
            opacity: 0;
        }

        /*Para que la primera imagen este activa al inicio*/
        #slider img:nth-child(1) {
            opacity: 1;
        }

        table {
            margin: 0 auto;
            width: 800px;
            height: auto;
            overflow: hidden;
            background-color: white;
            border: 0;
        }

        #izquierda {
            text-align: right;
        }

        #derecha {
            text-align: left;
        }

        .flecha-slider {
            width: 100px;
        }
    </style>
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
        <h1 class="float-left tituloHeader2">{{ $carrera->nombre }}</h1>
        @include('layouts.2Header')
    </div>

    <nav>
        <div class="nav nav-tabs mt-2" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active text-dark" id="nav-info-tab" data-toggle="tab" href="#nav-info"
                role="tab" aria-controls="nav-info" aria-selected="true">Informacion</a>
            <a class="nav-item nav-link text-dark" id="nav-imagenes-tab" data-toggle="tab" href="#nav-imagenes"
                role="tab" aria-controls="nav-imagenes" aria-selected="false">Imagenes</a>
            <a class="nav-item nav-link text-dark" id="nav-classi-tab" data-toggle="tab" href="#nav-classi"
                role="tab" aria-controls="nav-classi" aria-selected="false">Classificacion</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active my-3" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
            <div class="datos">
                <div>
                    <p class="text-break">{{ $carrera->descripcion }}</p>
                </div>
                <div>
                    <p>{{ $carrera->tipo }} de {{ $carrera->km }}km</p>
                </div>
                <div>
                    <p>{{ \Carbon\Carbon::parse($carrera->fechaHora)->format('d-m-Y - H:i') }}</p>
                </div>
            </div>
            <div class="row my-1 mx-0 d-flex justify-content-center">
                <div class="card mr-5">
                    <img src="{{ asset('storage/' . $carrera->cartel) }}" alt="Cartel de {{ $carrera->nombre }}" width="500" height="500">
                    <div class="card-body">
                        <h3 class="text-center">Cartel</h3>
                    </div>
                </div>
                <div class="card ml-5">
                    <img src="{{ asset('storage/' . $carrera->lugar_foto) }}" alt="Lugar de {{ $carrera->nombre }}" width="500" height="500">
                    <div class="card-body">
                        <h3 class="text-center">Foto del Lugar</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade my-3" id="nav-imagenes" role="tabpanel" aria-labelledby="nav-imagenes-tab">
            <div>
                @if ($fotos->isEmpty())
                    <p>De momento no hay fotos</p>
                @else
                    <div>
                        <table>
                            <tr>
                                <td id="izquierda">
                                    <input type="image" class="btn bg-transparent flecha-slider"
                                        src="{{ asset('img/felcha-izquierda.svg') }}" onclick="cambiarManual('IZQ')">
                                </td>
                                <td>
                                    <div id="slider">
                                        @foreach ($fotos as $carreraFoto)
                                            <img src="{{ asset('storage/' . $carreraFoto->foto) }}"
                                                alt="{{ $carreraFoto->id_foto }}">
                                        @endforeach
                                    </div>
                                </td>
                                <td id="derecha">
                                    <input type="image" class="btn bg-transparent flecha-slider"
                                        src="{{ asset('img/felcha-derecha.svg') }}" onclick="cambiarManual('DER')">
                                </td>
                            </tr>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <div class="tab-pane fade my-3" id="nav-classi" role="tabpanel" aria-labelledby="nav-classi-tab">
            <div class="row my-1 mx-0 d-flex justify-content-center">
                @php
                    $contador = 1;
                @endphp
                @foreach ($participantes as $participante)
                    <div class="card mr-5">
                        <img src="{{ asset('storage/' . $participante->jinete->foto) }}" alt="{{ $participante->jinete->id_jinete }}" width="500" height="500">
                        <div class="card-body">
                            <h3 class="text-center">{{ $contador }}. {{ $participante->jinete->nombre }} {{ $participante->jinete->apellido }}</h3>
                        </div>
                    </div>
                    @php
                        $contador++;
                    @endphp
                @endforeach
            </div>
        </div>   
    </div>

    <script>
        /*Cargador de eventos al iniciar la página*/
        window.addEventListener('load', iniciar, false);

        /*Contador inicializado en cero*/
        var contador = 0;

        function iniciar() {
            setInterval('cambiarImg()', 5000);
        }

        var obj = document.getElementById('slider');
        var obj2 = obj.getElementsByTagName('img');

        function cambiarManual(sentido) {
            if (sentido == "DER") {
                obj2[contador].style.opacity = 0;
                if (contador < obj2.length - 1) {
                    contador++;
                    obj2[contador].style.opacity = 1;
                    console.log('Contador vale ' + contador + ' Longitud ' + obj2.length);
                } else {
                    contador = 0;
                    obj2[contador].style.opacity = 1;
                    console.log('Contador vale ' + contador + ' Longitud ' + obj2.length);
                }
            } else if (sentido == "IZQ") {
                obj2[contador].style.opacity = 0;
                if (contador != 0) {
                    contador--;
                    obj2[contador].style.opacity = 1;
                } else {
                    contador = obj2.length - 1;
                    obj2[contador].style.opacity = 1;
                }
            }
        }

        function cambiarImg() {

            if (contador == obj2.length) {
                for (var i = 0; i < obj2.length; i++) {
                    obj2[i].style.opacity = '0';
                    contador--;
                }
                obj2[contador].style.opacity = '1';
            } else {
                obj2[contador].style.opacity = '1';
                contador++;
            }

        }
    </script>
</body>
@include('layouts.footer')

</html>
