<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\SponsorCarrera;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class CarrerasController extends Controller
{

    public function carreras()
    {
    }

    public function mostrarCarreras()
    {
        $carreras = Carrera::all();
        return view('admin.AdminCarreras', compact('carreras'));
    }

    public function mostrarCarrerasClientes()
    {
        $carreras = Carrera::all();
        return view('enlaces.tickets', compact('carreras'));
    }


    // Método para mostrar el formulario de creación de carreras
    public function create()
    {
        return view('admin.create');
    }

    // Método para guardar la carrera creada
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

    public function cambiarActivo($id)
    {
        $carrera = Carrera::findOrFail($id);
        $carrera->activo = !$carrera->activo;
        $carrera->save();

        return response()->json(['activo' => $carrera->activo]);
    }

    public function editarCarrera($id)
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $carrera = Carrera::findOrFail($id);  // Obtener el jinete por su ID
        //return view('Admin.Formularios.editarJinete', compact('carrera', 'adminId', 'adminName'));
    }

    public function patrocinioCarrera($id)
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $sponsorCarreras = SponsorCarrera::where('id_carrera', $id)->with('sponsor')->get();
        $sponsorsActivos = Sponsor::where('activo', true)->get(); // Obtén todos los sponsors activos

        return view('admin.patrocinioCarrera', compact('sponsorCarreras', 'sponsorsActivos'));
    }

    public function nuevoPatrocinio(Request $request, $id)
    {
        $request->validate([
            'id_sponsor' => 'required',
            'patrocinio' => 'required',
        ]);

        try {
            $nuevoSponsorCarrera = new SponsorCarrera([
                'id_carrera' => $id,
                'id_sponsor' => $request->input('id_sponsor'),
                'patrocinio' => $request->input('patrocinio'),
            ]);

            $nuevoSponsorCarrera->save();

            return redirect()->route('admin.patrocinioCarrera', $id)->with('Guardado', 'Aseguradora agregada exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['ERROR' => 'Hubo un problema al procesar la solicitud']);
        }
    }
}
