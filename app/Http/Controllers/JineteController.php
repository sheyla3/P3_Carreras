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

        return redirect()->route('jinete.nuevo');
    }

    public function mostrarJinetes()
    {
        $jinetes = Jinete::all();
        return view('admin.AdminJinetes', compact('jinetes'));
    }
}
