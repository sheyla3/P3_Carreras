<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function formularioInicio() {
        return view("Admin.loginAdmin");
    }

    public function AdminIniciar(Request $request) {
        $request->validate([
	        'usuario' => 'required',
	        'contra' => 'required',
	    ]);

        $usuario = $request->input("usuario");
        $contra = $request->get("contra");
    }
}
