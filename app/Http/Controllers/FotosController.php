<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrera;
use App\Models\Foto;

class FotosController extends Controller
{
    public function mostrarFotos()
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $carreras = Carrera::carrerasAntiguas();
        return view('admin.AdminFotos', compact('carreras', 'adminId', 'adminName'));
    }

    public function anadirFoto(Request $request)
    {
        $request->validate([
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $carreraId = $request->input('carrera_id');
        $fotos = $request->file('fotos');

        foreach ($fotos as $foto) {
            if ($foto->isValid()) {
                // Guarda la foto en la carpeta de almacenamiento y registra en la base de datos con el ID de la carrera
                $ruta = $foto->store('FotoCarreras', 'public');
                Foto::create(['id_carrera' => $carreraId, 'foto' => $ruta]);
            } else {
                return redirect()->back()->withErrors(['error' => 'Uno o más archivos no son imágenes.']);
            }
        }

        return redirect()->back()->with('Añadido', 'Fotos subidas con éxito');
    }

    public function verFotos($id)
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }
        $idCarrera = $id;
        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $carreraFotos = Foto::FotoCarrera($id);
        return view('admin.fotosCarrera', compact('carreraFotos', 'idCarrera', 'adminId', 'adminName'));
    }

    public function eliminarFoto($id)
    {
        $fotosEliminar = Foto::find($id);

        if ($fotosEliminar) {
            $fotosEliminar->delete();
        }
        return redirect()->route('verFotos');
    }

    public function eliminarTodasFotos($id)
    {
        $fotosEliminar = Foto::ELiminarFotos($id);
        foreach ($fotosEliminar as $foto) {
            $foto->delete();
        }

        return redirect()->route('verFotos', $id);
    }

    public function buscarFoto(Request $request) {
        $search = $request->input('buscar');
    
        // Buscar carreras que coincidan con el término de búsqueda
        $carreras = Carrera::where('nombre', 'LIKE', "%$search%")->get();
    
        // Retornar la vista con las carreras encontradas
        return view('admin.adminFotos', compact('carreras'));
    }
    
    
    
}
