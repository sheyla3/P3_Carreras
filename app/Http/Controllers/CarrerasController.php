<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

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
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'lugar_foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cartel' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'fechaHora' => 'required|date',
            'precio' => 'required|integer',
            'km' => 'required|integer',
            'tipo' => 'required|in:plano,vallas,campo a traves,trote y arnes,parejeras',
        ]);

        if ($request->hasFile('lugar_foto')) {
            $rutaArchivo1 = $request->file('lugar_foto')->store('Lugares', 'public');
        }

        if ($request->hasFile('cartel')) {
            $rutaArchivo2 = $request->file('cartel')->store('Carteles', 'public');
        }

        try {
            $nuevoCarrera = new Carrera([
                'nombre' => $request->input('nombre'),
                'descripcion' => $request->input('descripcion'),
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
}
