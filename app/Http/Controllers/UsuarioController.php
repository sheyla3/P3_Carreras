<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function loginUsuario(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input("correo");
        $password = $request->input("password");

        $confUsu = Usuario::loginUsuario($email);

        if ($confUsu && Hash::check($password, $confUsu->contrasena)) {
            session(['socio_id' => $confUsu->id_usuario, 'socio_name' => $confUsu->correo]);

            return redirect()->route('/');
        } else {
            return redirect()->back()->withErrors(['password' => 'La contraseña es incorrecta']);
        }
    }

    public function registroUsuario(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telf' => 'required',
            'dni' => 'required',
            'edad' => 'required',
            'correo' => 'required',
            'contrasena' => 'required',
        ]);

        // Crea un nuevo usuario
        $usuario = new Usuario;
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->telf = $request->telf;
        $usuario->dni = $request->dni;
        $usuario->edad = $request->edad;
        $usuario->correo = $request->correo;
        $usuario->contrasena = Hash::make($request->id_usuario);
        $usuario->save();

        // Autentica al usuario
        Auth::loginUsingId($usuario->correo);

        return redirect()->route('/');
    }

    public function cerrarSesion(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('/');
    }
}
