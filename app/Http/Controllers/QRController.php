<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function generarQR($id_carrera, $id_jinete, $dorsal, $fechaHora)
    {
        // Formatear la información para el QR
        $informacion = "Carrera: $id_carrera\nJinete: $id_jinete\nDorsal: $dorsal\nFecha y Hora: $fechaHora";

        // Generar el código QR con la información
        $qrUrl = route('nombre_de_la_ruta', [
            'id_carrera' => $id_carrera,
            'id_jinete' => $id_jinete,
            'dorsal' => $dorsal,
            'fechaHora' => $fechaHora
        ]);

        // Aquí deberías retornar la URL, no el código QR
        return $qrUrl;
    }
}
