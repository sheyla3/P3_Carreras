<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

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
    }
}
