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
        <h1 class="float-left tituloHeader2">Carreras</h1>
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
                        <p>Carrera {{ $carrera->tipo }} de {{ $carrera->km }}km</p>
                    </div>
                    <div>
                        <p class="text-break">{{ \Carbon\Carbon::parse($carrera->fechaHora)->format('d-m-Y - H:i') }}
                        </p>
                    </div>
                    <div>
                        <p>Participantes: {{ $participantesActuales[$carrera->id_carrera] }} /
                            {{ $carrera->max_participantes }}</p>
                    </div>
                </div>

                @if (isset($jineteId) && $carrera->participantes()->where('id_jinete', $jineteId)->exists())
                    <div class="clasificacion2">
                        <a
                            href="{{ route('desinscribirse', ['id_carrera' => $carrera->id_carrera, 'id_jinete' => $jineteId]) }}"><button>Inscrito</button></a>
                    </div>
                @else
                    <div class="clasificacion">
                        <a
                            href="{{ route('inscribirse', ['id_carrera' => $carrera->id_carrera, 'id_jinete' => $jineteId]) }}"><button>Inscribirse</button></a>
                    </div>
                @endif
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
    @if (session('Inscrito'))
        <div class="modal" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ session('Inscrito') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#successModal').modal('show');
            });
        </script>
    @endif

    @if (session('Desinscrito'))
        <div class="modal" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ session('Desinscrito') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#successModal').modal('show');
            });
        </script>
    @endif

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

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#qrModal">
        Ver mi QR
    </button>


    <div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel">Mi Código QR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @foreach ($carreras as $carrera)
                        <!-- Aquí tu código para mostrar la información de la carrera -->

                        <!-- Obtener información del jinete -->
                        <?php
                        $jinete = App\Models\Jinete::find($carrera->id_jinete);
                        ?>

                        <!-- Verificar si se encontró el jinete -->
                        @if ($jinete)
                            <!-- Aquí tu código para mostrar la imagen del código QR -->
                            <img src="{{ route('qr', ['id_carrera' => $carrera->id, 'id_jinete' => $jinete->id, 'dorsal' => $dorsal, 'fechaHora' => $fechaHora]) }}"
                                alt="Código QR">
                        @else
                            <!-- Manejar el caso donde no se encuentra el jinete -->
                            <p>No se encontró información del jinete para esta carrera.</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</body>
@include('layouts.footer')

</html>
