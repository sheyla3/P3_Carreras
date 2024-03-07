<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SponsorController extends Controller
{
    public function nuevo(Request $request)
    {
        $request->validate([
            'cif' => 'required',
            'nombre' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'calle' => 'required',
        ]);

        $rutaArchivo = $request->file('logo');
        $nombreArchivo = basename($rutaArchivo);

        $nuevoSponsor = new Sponsor([
            'CIF' => $request->input('cif'),
            'nombre' => $request->input('nombre'),
            'logo' => $nombreArchivo,
            'calle' => $request->input('calle'),
            'destacado' => $request->has('destacado'),
            'activo' => true,
        ]);

        $nuevoSponsor->save();

        return redirect()->route('formularioSponsor')->with('Guardado', 'Sponsor agregado exitosamente');
    }

    public function formularioSponsor()
    {
        return view('Admin.Formularios.NuevoSponsor');
    }


    public function mostrarSponsors()
    {
        $sponsors = Sponsor::all();
        return view('admin.adminSponsors', compact('sponsors'));
    }

    public function editarSponsor($id)
    {
        $sponsor = Sponsor::findOrFail($id);  // Obtener el sponsor por su ID
        return view('Admin.Formularios.editarSponsor', compact('sponsor'));
    }

    public function editar(Request $request, $id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $request->validate([
            'cif' => 'required',
            'nombre' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'calle' => 'required',
        ]);
        // Verificar si se proporcionó una nueva imagen
        if ($request->hasFile('logo')) {
            $rutaArchivo = $request->file('logo')->store('public/img/sponsors');
            $nombreArchivo = basename($rutaArchivo);
            $sponsor->logo = $nombreArchivo;
        }
        $sponsor->CIF = $request->input('cif');
        $sponsor->nombre = $request->input('nombre');
        $sponsor->calle = $request->input('calle');
        // Verificar si se seleccionó destacado
        $sponsor->destacado = $request->has('destacado');
        $sponsor->activo = true;

        $sponsor->save();

        return redirect()->route('editarSponsor', $id)->with('Editado', 'Sponsor editado exitosamente');
    }
}
