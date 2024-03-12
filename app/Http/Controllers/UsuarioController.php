<?php

namespace App\Http\Controllers;
use App\Models\Usuario;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    // Método para manejar el envío del formulario
    public function loginUsuario(Request $request)
    {
        // Validar los datos del formulario
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Intentar autenticar al usuario
        if (Usuario::attempt($credentials)) {
            // Si la autenticación es exitosa, redirigir al usuario a una página de inicio o a donde sea necesario
            return redirect()->intended('dashboard');
        } else {
            // Si la autenticación falla, redirigir de vuelta al formulario con un mensaje de error
            return back()->withErrors(['email' => 'Credenciales inválidas']);
        }
    }}
