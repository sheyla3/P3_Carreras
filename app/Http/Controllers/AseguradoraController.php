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
        
        $nuevoSponsor = new Aseguradora([
            'CIF' => $request->input('cif'),
            'nombre' => $request->input('nombre'),
            'calle' => $request->input('calle'),
            'precio' => $request->input('precio'),
            'activo' => true, 
        ]);

        $nuevoSponsor->save();

        return redirect()->route('formularioAseguradora')->with('Guardado', 'Aseguradora agregada exitosamente');
    }

    public function formularioAseguradora(){
        return view('Admin.Formularios.NuevaAseguradora');
    }


    public function mostrarAseguradoras()
    {
        $aseguradoras = Aseguradora::all();
        return view('admin.adminAseguradoras', compact('aseguradoras'));
    }

    public function editarAseguradora($id)
    {
        $aseguradora = Aseguradora::findOrFail($id);  // Obtener el jinete por su ID
        return view('Admin.Formularios.EditarAseguradora', compact('aseguradora'));
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
}