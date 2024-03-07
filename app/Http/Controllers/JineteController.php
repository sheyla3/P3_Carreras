<?php

namespace App\Http\Controllers;

use App\Models\Jinete;
use Illuminate\Http\Request;

class JineteController extends Controller
{
    public function nuevo(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required',
            'contra' => 'required',
            'telf' => 'required',
            'calle' => 'required',
            'num_fede' => 'required',
            'edad' => 'required',
        ]);

        $nuevoJinete = new Jinete();
        $nuevoJinete->nombre = $request->input('nombre');
        $nuevoJinete->apellido = $request->input('apellido');
        $nuevoJinete->correo = $request->input('correo');
        $nuevoJinete->contrasena = $request->input('contra');
        $nuevoJinete->telf = $request->input('telf');
        $nuevoJinete->calle = $request->input('calle');
        $nuevoJinete->num_federat = $request->input('num_fede');
        $nuevoJinete->edad = $request->input('edad');
        $nuevoJinete->activo = true;

        $nuevoJinete->save();

        return redirect()->route('formularioJinete')->with('Guardado', 'Jinete agregado exitosamente');
    }

    public function mostrarJinetes()
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $jinetes = Jinete::all();
        return view('admin.adminJinetes', compact('jinetes','adminId', 'adminName'));
    }

    public function formularioJinete()
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        return view('Admin.Formularios.NuevoJinete', compact('adminId', 'adminName'));
    }

    public function editarJinete($id)
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $jinete = Jinete::findOrFail($id);  // Obtener el jinete por su ID
        return view('Admin.Formularios.editarJinete', compact('jinete','adminId', 'adminName'));
    }

    public function editar(Request $request, $id)
    {
        $jinete = Jinete::find($id);
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required',
            'contra' => 'required',
            'telf' => 'required',
            'calle' => 'required',
            'num_fede' => 'required',
            'edad' => 'required',
        ]);

        $fechaNacimiento = \DateTime::createFromFormat('d/m/Y', $request->input('edad'))->format('Y-m-d');
        $jinete->update([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'correo' => $request->input('correo'),
            'contrasena' => $request->input('contra'),
            'telf' => $request->input('telf'),
            'calle' => $request->input('calle'),
            'num_federat' => $request->input('num_fede'),
            'edad' => $fechaNacimiento,
        ]);

        return redirect()->route('editarJinete', $id)->with('Editado', 'Jinete editado exitosamente');
    }

    public function cambiarActivo($id)
    {
        $jinete = Jinete::findOrFail($id);
        $jinete->activo = !$jinete->activo;
        $jinete->save();

        return response()->json(['activo' => $jinete->activo]);
    }
}
