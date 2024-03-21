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
        $carreras = Carrera::where('activo', true)->get();
        return view('admin.AdminFotos', compact('carreras', 'adminId', 'adminName'));
    }

    public function anadirFoto(Request $request)
    {
        $carreraId = $request->input('carrera_id');
        $fotos = $request->file('fotos');

        foreach ($fotos as $foto) {
            // Guardar la foto en la carpeta de almacenamiento y registrarla en la base de datos con el ID de la carrera
            $ruta = $foto->store('FotoCarreras', 'public');
            Foto::create(['id_carrera' => $carreraId, 'foto' => $ruta]);
        }

        return redirect()->back()->with('success', 'Fotos subidas con éxito');
    }

    public function verFotos($id)
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }
        $idCarrera = $id;
        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $carreraFotos = Foto::where('id_carrera', $id)->with('carrera')->get();
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
        $idCarrera = $id;
        // Obtener todas las fotos asociadas a la carrera
        $fotosEliminar = Foto::where('id_carrera', $idCarrera)->get();
        foreach ($fotosEliminar as $foto) {
            $foto->delete();
        }

        return redirect()->route('verFotos', $idCarrera);
    }
}
