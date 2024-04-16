<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jinete;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function mostrarPerfil($id)
    {
        // Encuentra al jinete por su ID
        $jinete = Jinete::findOrFail($id);
        
        // Pasar los datos del jinete a la vista
        if (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            return view('Enlaces.perfil', compact('jinete', 'jineteId', 'jineteName'));
        }
    }
}
