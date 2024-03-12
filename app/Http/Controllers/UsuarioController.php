<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function formularioInicio()
    {
        return view("Usuario.loginUsuario");
    }

    public function loginUsuario(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input("correo");
        $password = $request->input("password");

        $confUsu = Usuario::where('correo', $email)->first();

        if (!$confUsu) {
            return redirect()->back()->withErrors(['correo' => 'El correo no existe']);
        }

        if ($password === $confUsu->contrasena) {
            // Guardar información del usuario en la sesión
            session(['socio_id' => $confUsu->id_usuario, 'socio_name' => $confUsu->correo]);

            return redirect()->route('Admin_panel');
        } else {
            return redirect()->back()->withErrors(['contra' => 'La contraseña es incorrecta']);
        }
    }

    public function cerrarSesion(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('formularioInicio');
    }

}
