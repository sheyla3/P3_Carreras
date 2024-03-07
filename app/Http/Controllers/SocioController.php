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
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'correo' => 'required|email|unique:usuario',
            'contrasena' => 'required|min:6',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'telf' => 'required|string|max:255',
            'dni' => 'required|string|max:255',
            'edad' => 'required|date',
        ]);

        // Crear una nueva instancia de Usuario con los datos validados y guardarla en la base de datos
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

        // Redirigir a la ruta del formulario de socio con un mensaje de éxito
        return redirect()->route('formularioSocio')->with('success', 'Socio creado exitosamente.');
    }
}
