<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Sponsor;
use App\Models\Foto;
use App\Models\SponsorCarrera;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

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
        if (session()->has('socio_id') && session()->has('socio_name')) {
            $socioId = session('socio_id');
            $socioName = session('socio_name');
            $carreras = Carrera::all();
            return view('index', compact('carreras', 'socioId', 'socioName'));
        } elseif (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            $carreras = Carrera::all();
            return view('index', compact('carreras', 'jineteId', 'jineteName'));
        } else {
            $carreras = Carrera::all();
            return view('index', compact('carreras'));
        }
    }


    public function mostrarCarrerasClientes()
    {
        $fechaActual = Carbon::now()->toDateString();

        if (session()->has('socio_id') && session()->has('socio_name')) {
            $socioId = session('socio_id');
            $socioName = session('socio_name');
            $carreras = Carrera::whereDate('fechaHora', '>', $fechaActual)->where('activo', true)->get();
            return view('Enlaces.tickets', compact('carreras', 'socioId', 'socioName'));
        } elseif (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            $carreras = Carrera::whereDate('fechaHora', '>', $fechaActual)->where('activo', true)->get();
            return view('Enlaces.tickets', compact('carreras', 'jineteId', 'jineteName'));
        } else {
            $carreras = Carrera::whereDate('fechaHora', '>', $fechaActual)->where('activo', true)->get();
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
            $fechaHora = Carbon::parse($request->input('fechaHora'));

            $nuevoCarrera = new Carrera([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
                'tipo' => $request->input('tipo'),
                'lugar_foto' => $rutaArchivo1,
                'km' => $request->input('km'),
                'fechaHora' => $fechaHora,
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
        $sponsorCarreras = SponsorCarrera::where('id_carrera', $id)->with('carrera')->get();
        $sponsorsActivos = Sponsor::where('activo', true)->get(); // Obtén todos los carreras activos

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
        $fechaHora = Carbon::parse($request->input('fechaHora'));
        try {
            $carrera->nombre = $request->input('nombre');
            $carrera->descripcion = $request->input('descripcion');
            $carrera->tipo = $request->input('tipo');
            $carrera->lugar_foto = $rutaArchivo1;
            $carrera->km = $request->has('km');
            $carrera->fechaHora = $fechaHora;
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

        if (session()->has('socio_id') && session()->has('socio_name')) {
            $socioId = session('socio_id');
            $socioName = session('socio_name');
            $carreras = Carrera::whereDate('fechaHora', '<', $fechaActual)->where('activo', true)->get();
            return view('Enlaces.record', compact('carreras', 'socioId', 'socioName'));
        } elseif (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            $carreras = Carrera::whereDate('fechaHora', '<', $fechaActual)->where('activo', true)->get();
            return view('Enlaces.record', compact('carreras', 'jineteId', 'jineteName'));
        } else {
            $carreras = Carrera::whereDate('fechaHora', '<', $fechaActual)->where('activo', true)->get();
            return view('Enlaces.record', compact('carreras'));
        }
    }

    public function carreraAntigua($id)
    {
        $carrera = Carrera::findOrFail($id);
        $fotos = Foto::where('id_carrera', $id)->with('carrera')->get();

        if (session()->has('socio_id') && session()->has('socio_name')) {
            $socioId = session('socio_id');
            $socioName = session('socio_name');
            return view('Enlaces.CarreraAntigua', compact('carrera', 'fotos', 'socioId', 'socioName'));
        } elseif (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            return view('Enlaces.CarreraAntigua', compact('carrera', 'fotos', 'jineteId', 'jineteName'));
        } else {
            return view('Enlaces.CarreraAntigua', compact('carrera', 'fotos'));
        }
    }

    public function mostrarCarrerasJinetes()
    {
        $fechaActual = Carbon::now()->toDateString();

        if (session()->has('socio_id') && session()->has('socio_name')) {
            $socioId = session('socio_id');
            $socioName = session('socio_name');
            $carreras = Carrera::whereDate('fechaHora', '>', $fechaActual)->where('activo', true)->get();
            return view('Enlaces.carreras', compact('carreras', 'socioId', 'socioName'));
        } elseif (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            $carreras = Carrera::whereDate('fechaHora', '>', $fechaActual)->where('activo', true)->get();
            return view('Enlaces.carreras', compact('carreras', 'jineteId', 'jineteName'));
        } else {
            $carreras = Carrera::whereDate('fechaHora', '>', $fechaActual)->where('activo', true)->get();
            return view('Enlaces.carreras', compact('carreras'));
        }
    }
}
