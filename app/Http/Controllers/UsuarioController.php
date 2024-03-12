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
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input("email");
        $password = $request->input("password");

        // Intentar autenticar al usuario
        if (Auth::attempt(['correo' => $email, 'contrasena' => $password])) {
            // Si la autenticación es exitosa, redirigir al usuario a una página de inicio o a donde sea necesario
            return redirect()->route('pagina_inicio');
        } else {
            // Si la autenticación falla, redirigir de vuelta al formulario con un mensaje de error
            return redirect()->back()->withErrors(['email' => 'Credenciales inválidas']);
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
