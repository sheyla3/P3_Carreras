<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class SocioController extends Controller
{
    public function mostrarSocio()
    {
        $socios = Usuario::all();
        return view('admin.adminSocio', compact('socios'));
    }

    public function formularioSocio()
    {
        return view('Admin.Formularios.NuevoSocio');
    }

    public function guardarSocio(Request $request)
    {
        $validatedData = $request->validate([
            'correo' => 'required',
            'contrasena' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'telf' => 'required',
            'dni' => 'required',
            'edad' => 'required',
        ]);

        $nuevoSocio = new Usuario([
            'correo' => $validatedData['correo'],
            'contrasena' => $validatedData['contrasena'],
            'nombre' => $validatedData['nombre'],
            'apellido' => $validatedData['apellido'],
            'telf' => $validatedData['telf'],
            'dni' => $validatedData['dni'],
            'edad' => $validatedData['edad'],
        ]);

        $nuevoSocio->save();

        return redirect()->route('formularioSocio')->with('success', 'Socio creado exitosamente.');
    }
}
