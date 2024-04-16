<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Sponsor;
use App\Models\Participante;
use App\Models\Foto;
use App\Models\SponsorCarrera;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Dompdf\Dompdf;

class CarrerasController extends Controller
{
    public function mostrarCarreras()
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $carreras = Carrera::all();
        return view('admin.AdminCarreras', compact('carreras', 'adminId', 'adminName'));
    }

    public function index2()
    {
        $sponsorsDestacados = Sponsor::where('destacado', true)->where('activo', true)->get();
        $carreras = Carrera::carrerasPost();

        if (session()->has('socio_id') && session()->has('socio_name')) {
            $socioId = session('socio_id');
            $socioName = session('socio_name');
            return view('index', compact('carreras', 'sponsorsDestacados', 'socioId', 'socioName'));
        } elseif (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            return view('index', compact('carreras', 'sponsorsDestacados', 'jineteId', 'jineteName'));
        } else {
            return view('index', compact('carreras', 'sponsorsDestacados'));
        }
    }

    public function mostrarCarrerasClientes()
    {
        $fechaActual = Carbon::now()->toDateString();
        $carreras = Carrera::carrerasPostPag();

        if (session()->has('socio_id') && session()->has('socio_name')) {
            $socioId = session('socio_id');
            $socioName = session('socio_name');
            return view('Enlaces.tickets', compact('carreras', 'socioId', 'socioName'));
        } elseif (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            return view('Enlaces.tickets', compact('carreras', 'jineteId', 'jineteName'));
        } else {
            return view('Enlaces.tickets', compact('carreras'));
        }
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required',
                'descripcion' => 'required',
                'tipo' => 'required',
                'lugar_foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'km' => 'required|integer',
                'fechaHora' => 'required',
                'cartel' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'precio' => 'required|integer'
            ]);

            if ($request->hasFile('lugar_foto')) {
                $rutaArchivo1 = $request->file('lugar_foto')->store('Lugares', 'public');
            }

            if ($request->hasFile('cartel')) {
                $rutaArchivo2 = $request->file('cartel')->store('Carteles', 'public');
            }

            $nuevoCarrera = new Carrera([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'tipo' => $request->input('tipo'),
                'lugar_foto' => $rutaArchivo1,
                'km' => $request->input('km'),
                'fechaHora' => $request->input('fechaHora'),
                'cartel' => $rutaArchivo2,
                'precio' => $request->input('precio'),
                'activo' => true,
            ]);

            $nuevoCarrera->save();

            return redirect()->route('carreras.create')->with('Guardado', 'Carrera agregada exitosamente');
        } catch (\Exception $e) {
            Log::error('Error al guardar carrera: ' . $e->getMessage());
            return redirect()->back()->withErrors(['ERROR' => 'Hubo un problema al procesar la solicitud']);
        }
    }

    public function editarCarrera($id)
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $carrera = Carrera::findOrFail($id);  // Obtener el jinete por su ID
        return view('Admin.Formularios.EditarCarrera', compact('carrera', 'adminId', 'adminName'));
    }

    public function patrocinioCarrera($id)
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $idCarrera = $id;
        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $sponsorCarreras = SponsorCarrera::SponsorCarreras($id);
        $sponsorsActivos = Sponsor::SponsorActivo();

        return view('admin.patrocinioCarrera', compact('sponsorCarreras', 'sponsorsActivos', 'adminId', 'adminName', 'idCarrera'));
    }

    public function nuevoPatrocinio(Request $request, $id)
    {
        $request->validate([
            'id_sponsor' => 'required',
            'patrocinio' => 'required',
        ]);
        $idCarrera = $id;
        $nuevocarreraCarrera = new SponsorCarrera([
            'id_carrera' => $idCarrera,
            'id_sponsor' => $request->input('id_sponsor'),
            'patrocinio' => $request->input('patrocinio'),
        ]);

        $nuevocarreraCarrera->save();

        return redirect()->route('patrocinioCarrera', $idCarrera);
    }

    public function editar(Request $request, $id)
    {
        $carrera = Carrera::findOrFail($id);
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'tipo' => 'required',
            'lugar_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'km' => 'required|integer',
            'fechaHora' => 'required',
            'cartel' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'precio' => 'required|integer'
        ]);

        if ($request->hasFile('lugar_foto')) {
            $rutaArchivo1 = $request->file('lugar_foto')->store('Lugar', 'public');
        } else {
            $rutaArchivo1 = $carrera->lugar_foto;
        }

        if ($request->hasFile('cartel')) {
            $rutaArchivo2 = $request->file('cartel')->store('Carteles', 'public');
        } else {
            $rutaArchivo2 = $carrera->cartel;
        }
        try {
            $carrera->nombre = $request->input('nombre');
            $carrera->descripcion = $request->input('descripcion');
            $carrera->tipo = $request->input('tipo');
            $carrera->lugar_foto = $rutaArchivo1;
            $carrera->km = $request->input('km');
            $carrera->fechaHora = $request->input('fechaHora');
            $carrera->cartel = $rutaArchivo2;
            $carrera->precio = $request->input('precio');
            $carrera->activo = true;
            $carrera->save();

            return redirect()->route('editarcarrera', $id)->with('Editado', 'carrera editado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['ERROR' => 'Hubo un problema al procesar la solicitud']);
        }
    }

    public function inactivo($id)
    {
        $carrera = Carrera::findOrFail($id);
        $carrera->activo = false;
        $carrera->save();
        return redirect()->route('AdminCarreras')->with('success', 'El estado de la carrera ha sido actualizado correctamente.');
    }

    public function activo($id)
    {
        $carrera = Carrera::findOrFail($id);
        $carrera->activo = true;
        $carrera->save();
        return redirect()->route('AdminCarreras');
    }

    public function mostrarCarrerasAntiguas()
    {
        $fechaActual = Carbon::now()->toDateString();
        $carreras = Carrera::carrerasAntiguasPag();

        if (session()->has('socio_id') && session()->has('socio_name')) {
            $socioId = session('socio_id');
            $socioName = session('socio_name');
            return view('Enlaces.record', compact('carreras', 'socioId', 'socioName'));
        } elseif (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            return view('Enlaces.record', compact('carreras', 'jineteId', 'jineteName'));
        } else {
            return view('Enlaces.record', compact('carreras'));
        }
    }

    public function carreraAntigua($id)
    {
        $carrera = Carrera::findOrFail($id);
        $fotos = Foto::FotoCarrera($id);
        $participantes = Participante::Classificacion($id);
        $sponsorCarreras = SponsorCarrera::MostrarSponsor($id);

        if (session()->has('socio_id') && session()->has('socio_name')) {
            $socioId = session('socio_id');
            $socioName = session('socio_name');
            return view('Enlaces.CarreraAntigua', compact('carrera', 'participantes', 'fotos', 'socioId', 'socioName', 'sponsorCarreras'));
        } elseif (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            return view('Enlaces.CarreraAntigua', compact('carrera', 'participantes', 'fotos', 'jineteId', 'jineteName', 'sponsorCarreras'));
        } else {
            return view('Enlaces.CarreraAntigua', compact('carrera', 'participantes', 'fotos', 'sponsorCarreras'));
        }
    }

    public function mostrarCarrerasJinetes()
    {
        $fechaActual = Carbon::now()->toDateString();
        $carreras = Carrera::carrerasPostPag();

        if (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');

            // Obtener el número de participantes actuales para cada carrera
            $participantesActuales = [];
            foreach ($carreras as $carrera) {
                $participantesActuales[$carrera->id_carrera] = $carrera->participantes()->count();
            }

            return view('Enlaces.carreras', compact('carreras', 'participantesActuales', 'jineteId', 'jineteName'));
        } else {
            return view('Enlaces.carreras', compact('carreras'));
        }
    }

    public function inscribirse($id_carrera, $id_jinete)
    {
        $carrera = Carrera::findOrFail($id_carrera);
        $maxParticipantes = $carrera->max_participantes;
        $participantes_actuales = Participante::where('id_carrera', $id_carrera)->count();

        try {
            if ($participantes_actuales <= $maxParticipantes) {
                $num_participante = $participantes_actuales + 1;

                $nuevo = new Participante([
                    'id_carrera' => $id_carrera,
                    'id_jinete' => $id_jinete,
                    'num_partcipante' => $num_participante,
                ]);

                $nuevo->save();

                return redirect()->route('carreras')->with('Inscrito', 'Te has inscrito exitosamente en la carrera.');
            } else {
                return redirect()->route('carreras')->with('ERROR', 'Lo siento, la carrera ya está completa.');
            }
        } catch (\Exception $e) {
            return redirect()->route('carreras')->with('ERROR', 'Hubo un problema al procesar la solicitud: ' . $e->getMessage());
        }
    }

    public function desinscribirse($id_carrera, $id_jinete)
    {
        try {
            $eliminar_participante = Participante::DesinscribirseCarrera($id_carrera, $id_jinete);
            $eliminar_participante->delete();

            return redirect()->route('carreras')->with('Desinscrito', 'Te has desinscrito exitosamente de la carrera.');
        } catch (\Exception $e) {
            return redirect()->route('carreras')->with('ERROR', 'Hubo un problema al procesar la solicitud.');
        }
    }

    public function listaJinetes($id)
    {
        $participantes = Participante::listaParticipantes($id);
        $jinetes = collect(); // Crear una colección vacía de jinetes

        foreach ($participantes as $participante) {
            $jinetes->push($participante->jinete);
        }

        return view('Enlaces.ListaJinetes', compact('jinetes'));
    }

    public function ImprimirClasiPDF($id)
    {
        $carrera = Carrera::findOrFail($id);
        $participantes = Participante::where('id_carrera', $id)->orderBy('tiempo')->with('jinete')->get();
        // Crea una instancia de Dompdf
        $pdf = new Dompdf();
        // Contenido HTML para el PDF
        $html = '<h1 style="text-align: center; ">' . $carrera->nombre . '</h1>';
        $html .= '<style>';
        $html .= 'table { width: 100%; border-collapse: collapse; }';
        $html .= 'th, td { padding: 10px; text-align: center; }';
        $html .= 'thead { background-color: #423333; color: white; }';
        $html .= '</style>';
        $html .= '<table>';
        $html .= '<thead><tr><th>Puesto</th><th>Nombre</th><th>Apellido</th><th>Tiempo</th></tr></thead>';
        $html .= '<tbody>';
        $contador = 1;
        foreach ($participantes as $participante) {
            $html .= '<tr>';
            $html .= '<td>' . $contador . '</td>';
            $html .= '<td>' . $participante->jinete->nombre . '</td>';
            $html .= '<td>' . $participante->jinete->apellido . '</td>';
            $html .= '<td>' . Carbon::parse($participante->tiempo)->format('H:i:s') . '</td>';
            $html .= '</tr>';
            $contador++;
        }
        $html .= '</tbody></table>';
        // Carga el HTML en Dompdf
        $pdf->loadHtml($html);
        // Renderiza el PDF
        $pdf->render();
        // Descarga el PDF
        return $pdf->stream('calsificacion.pdf');
    }

    public function FacturaPDF($subtotal, $total_quantity, $carrera_id)
    {
        $carrera = Carrera::findOrFail($carrera_id);
        $pdf = new Dompdf([
            'isPhpEnabled' => true,
            'isHtml5ParserEnabled' => true,
        ]);

        $html = '<h1 style="text-align: center;">' . $carrera->nombre . '</h1>';
        $html .= '<p class="text-break">' . $carrera->descripcion . '</p>';
        $html .= '<style>';
        $html .= 'table { width: 100%; border-collapse: collapse; }';
        $html .= 'th, td { padding: 10px; text-align: center; }';
        $html .= 'thead { background-color: #423333; color: white; }';
        $html .= 'img { display: block; }';
        $html .= '</style>';
        $html .= '<table>';
        $html .= '<thead><tr><th>Precio</th><th>Cantidad</th><th>Total</th></tr></thead>';
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td>' . $carrera->precio . '€</td>';
        $html .= '<td>' . $total_quantity . '</td>';
        $html .= '<td>' . $subtotal . '€</td>';
        $html .= '</tr>';
        $html .= '</tbody></table>';
        $html .= '<pagebreak>';
        $html .= '<h3 style="text-align: center;">Entradas</h3>';

        // Convertir la imagen a base64 y añadirla al HTML
        $entrada_image = file_get_contents(public_path("img/entrada.png"));
        $entrada_base64 = 'data:image/png;base64,' . base64_encode($entrada_image);
        for ($i = 0; $i < $total_quantity; $i++) {
            $html .= '<img src="' . $entrada_base64 . '" alt="entrada" width="500" height="250"><br>';

            // Agregar un salto de página después de cada imagen
            if (($i + 1) % 3 == 0) {
                $html .= '<pagebreak>';
            }
        }

        $pdf->loadHtml($html);
        $pdf->render();
        return $pdf->stream('factura.pdf');
    }

    public function FacturaSponsorCarrera($id)
    {
        $fechaActual = Carbon::now()->toDateString();
        $sponsorCarrera = SponsorCarrera::findOrFail($id);
        $sponsor = Sponsor::findOrFail($sponsorCarrera->id_sponsor);
        $carrera = Carrera::findOrFail($sponsorCarrera->id_carrera);
        // Crear una instancia de Dompdf
        $pdf = new Dompdf();
        // Contenido HTML para el PDF
        $html = '<h1 style="text-align: center;">' . $sponsor->nombre . '</h1>';
        $html .= '<style>';
        $html .= 'table { width: 100%; border-collapse: collapse; }';
        $html .= 'th, td { padding: 10px; text-align: center; }';
        $html .= 'thead { background-color: #423333; color: white; }';
        $html .= '</style>';
        $html .= '<table>';
        $html .= '<thead><tr><th>ID</th><th>Carrera</th><th>Fecha</th><th>Total</th></tr></thead>';
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td>' . $sponsorCarrera->id_sponsorCarrera . '</td>';
        $html .= '<td>' . $carrera->nombre . '</td>';
        $html .= '<td>' . $fechaActual . '</td>';
        $html .= '<td>' . $sponsorCarrera->patrocinio . '€</td>';
        $html .= '</tr>';
        $html .= '</tbody></table>';
        // Carga el HTML en Dompdf
        $pdf->loadHtml($html);
        // Renderiza el PDF
        $pdf->render();
        // Descarga el PDF
        return $pdf->stream('factura.pdf');
    }
}
