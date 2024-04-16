<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Jinete;
use App\Models\Participante;
use App\Models\Carrera;
use App\Models\Usuario;
use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function mostrarPerfil($id)
    {
        // Encuentra al jinet        
        $jinete = Jinete::findOrFail($id);

        // Pasar los datos del jinete a la vista
        if (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            return view('Enlaces.perfil', compact('jinete', 'jineteId', 'jineteName'));
        }
    }

    public function misCarreras($id)
    {
        $participantes = Participante::where('id_jinete', $id)->pluck('id_carrera')->toArray();
        $carreras = Carrera::whereIn('id_carrera', $participantes)->paginate(5);

        if (session()->has('jinete_id') && session()->has('jinete_name')) {
            $jineteId = session('jinete_id');
            $jineteName = session('jinete_name');
            return view('Enlaces.misCarreras', compact('carreras', 'jineteId', 'jineteName'));
        }
    }

    public function socioPerfil($id)
    {      
        $socio = Usuario::findOrFail($id);

        if (session()->has('socio_id') && session()->has('socio_name')) {
            $socioId = session('socio_id');
            $socioName = session('socio_name');
            return view('Enlaces.socioPerfil', compact('socio', 'socioId', 'socioName'));
        }
    }

    public function editarSocioVista($id_usuario)
    {      
        $socio = Usuario::findOrFail($id_usuario);

        if (session()->has('socio_id') && session()->has('socio_name')) {
            $socioId = session('socio_id');
            $socioName = session('socio_name');
            return view('Enlaces.editSocioPerfil', compact('socio', 'socioId', 'socioName'));
        }
    }

    public function editarSocio(Request $request, $id_usuario)
    {
        $socio = Usuario::findOrFail($id_usuario);
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'telf' => 'required',
            'lugar_foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'km' => 'required|integer',
            'fechaHora' => 'required',
            'cartel' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'precio' => 'required|integer'
        ]);

        try {
            $socio->nombre = $request->input('nombre');
            $socio->descripcion = $request->input('descripcion');
            $socio->tipo = $request->input('tipo');
            $socio->km = $request->input('km');
            $socio->fechaHora = $request->input('fechaHora');
            $socio->precio = $request->input('precio');
            $socio->activo = true;
            $socio->save();

            return redirect()->route('editarSocio', $id_usuario);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['ERROR' => 'Hubo un problema al procesar la solicitud']);
        }
    }
}
