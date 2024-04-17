<?php

namespace App\Http\Controllers;

use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Writer;

class QRController extends Controller
{
    public function generateQR()
    {
        // Datos para el código QR (por ejemplo, información de la inscripción)
        $data = "Datos que quieres incluir en el código QR";

        // Crea un objeto Writer
        $writer = new Writer(new Png());

        // Renderiza el código QR como un archivo PNG
        $pngData = $writer->writeString($data);

        // Devuelve el archivo PNG
        return response($pngData)->header('Content-Type', 'image/png');
    }
}
