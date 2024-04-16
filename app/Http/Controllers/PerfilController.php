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
        // $jinete = Jinete::findOrFail($id);
        
        // Pasar los datos del jinete a la vista
        return view('perfil', compact('jinete'));
    }
}
