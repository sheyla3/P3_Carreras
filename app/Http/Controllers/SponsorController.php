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

        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['ERROR' => 'Hubo un problema al procesar la solicitud']);
        }
    }

    public function formularioSponsor()
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        return view('Admin.Formularios.NuevoSponsor',  compact('adminId', 'adminName'));
    }


    public function mostrarSponsors()
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $sponsors = Sponsor::all();
        return view('admin.adminSponsors', compact('sponsors', 'adminId', 'adminName'));
    }

    public function editarSponsor($id)
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $sponsor = Sponsor::findOrFail($id);  // Obtener el sponsor por su ID
        return view('Admin.Formularios.editarSponsor', compact('sponsor', 'adminId', 'adminName'));
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
        
        try {
            $sponsor->CIF = $request->input('cif');
            $sponsor->nombre = $request->input('nombre');
            $sponsor->logo = $rutaArchivo;
            $sponsor->calle = $request->input('calle');
            $sponsor->destacado = $request->has('destacado');
            $sponsor->activo = true;

            $sponsor->save();

            return redirect()->route('editarSponsor', $id)->with('Editado', 'Sponsor editado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['ERROR' => 'Hubo un problema al procesar la solicitud']);
        }
    }

    public function cambiarActivo($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->activo = !$sponsor->activo;
        $sponsor->save();

        return response()->json(['activo' => $sponsor->activo]);
    }
}
