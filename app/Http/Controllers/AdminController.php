<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Models\Carrera;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function formularioInicio()
    {
        return view("Admin.loginAdmin");
    }

    public function AdminIniciar(Request $request)
    {
        $request->validate([
            'usuario' => 'required',
            'contra' => 'required',
        ]);

        $usuario = $request->input("usuario");
        $contra = $request->get("contra");

        $confUsu = Admin::where('usuario', $usuario)->first();

        if (!$confUsu) {
            return redirect()->back()->withErrors(['usuario' => 'El usuario no existe']);
        }

        if ($contra === $confUsu->contrasena) {
            // Guardar información del usuario en la sesión
            session(['admin_id' => $confUsu->id_admin, 'admin_name' => $confUsu->usuario]);

            return redirect()->route('Admin_panel');
        } else {
            return redirect()->back()->withErrors(['contra' => 'La contraseña es incorrecta']);
        }
    }

    public function CerrarSesion(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('loginAdmin');
    }


    public function Admin_panelCarreras(Request $request)
    {
        $carreras = Carrera::all();
        return view('admin/admincarreras', compact('carreras'));
    }
}
