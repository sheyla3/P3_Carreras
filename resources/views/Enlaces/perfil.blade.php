<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        
</body>
</html>