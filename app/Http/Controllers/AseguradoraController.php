<?php

namespace App\Http\Controllers;

use App\Models\Aseguradora;
use Illuminate\Http\Request;

class AseguradoraController extends Controller
{
    public function nuevo(Request $request)
    {
        $request->validate([
            'cif' => 'required',
            'nombre' => 'required',
            'calle' => 'required',
            'precio' => 'required',
        ]);

        $nuevoaseguradora = new Aseguradora([
            'CIF' => $request->input('cif'),
            'nombre' => $request->input('nombre'),
            'calle' => $request->input('calle'),
            'precio' => $request->input('precio'),
            'activo' => true,
        ]);

        $nuevoaseguradora->save();

        return redirect()->route('formularioAseguradora')->with('Guardado', 'Aseguradora agregada exitosamente');
    }

    public function formularioAseguradora()
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');

        return view('Admin.Formularios.NuevaAseguradora', compact('adminId', 'adminName'));
    }


    public function mostrarAseguradoras()
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');

        $aseguradoras = Aseguradora::all();
        return view('admin.adminAseguradoras', compact('aseguradoras','adminId', 'adminName'));
    }

    public function editarAseguradora($id)
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $aseguradora = Aseguradora::findOrFail($id);  // Obtener la aseguradora por su ID
        return view('Admin.Formularios.EditarAseguradora', compact('aseguradora','adminId', 'adminName'));
    }

    public function editar(Request $request, $id)
    {
        $aseguradora = Aseguradora::find($id);
        $request->validate([
            'cif' => 'required',
            'nombre' => 'required',
            'calle' => 'required',
            'precio' => 'required',
        ]);

        $aseguradora->update([
            'CIF' => $request->input('cif'),
            'nombre' => $request->input('nombre'),
            'calle' => $request->input('calle'),
            'precio' => $request->input('precio'),
            'activo' => true,
        ]);

        return redirect()->route('editarAseguradora', $id)->with('Editado', 'Aseguradora editada exitosamente');
    }

    public function cambiarActivo($id)
    {
        $aseguradora = Aseguradora::findOrFail($id);
        $aseguradora->activo = !$aseguradora->activo;
        $aseguradora->save();

        return response()->json(['activo' => $aseguradora->activo]);
    }
}
