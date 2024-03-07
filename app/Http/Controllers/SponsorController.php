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
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'calle' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $rutaArchivo = $request->file('logo')->store('Logos', 'public');
        }

        $nuevoSponsor = new Sponsor([
            'CIF' => $request->input('cif'),
            'nombre' => $request->input('nombre'),
            'logo' => $rutaArchivo,
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
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'calle' => 'required',
        ]);

        if ($request->hasFile('logo')) {
            $rutaArchivo = $request->file('logo')->store('Logos', 'public');
        } else {
            $rutaArchivo = $sponsor->logo;
        }        

        $sponsor->CIF = $request->input('cif');
        $sponsor->nombre = $request->input('nombre');
        $sponsor->logo = $rutaArchivo;
        $sponsor->calle = $request->input('calle');
        $sponsor->destacado = $request->has('destacado');
        $sponsor->activo = true;

        $sponsor->save();

        return redirect()->route('editarSponsor', $id)->with('Editado', 'Sponsor editado exitosamente');
    }

    public function cambiarActivo($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->activo = !$sponsor->activo;
        $sponsor->save();

        return response()->json(['activo' => $sponsor->activo]);
    }
}
