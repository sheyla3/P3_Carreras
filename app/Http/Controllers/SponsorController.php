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
            'destacado' => 'required',
        ]);

        $rutaArchivo = $request->file('logo')->store('public/img/sponsors');
        $nombreArchivo = basename($rutaArchivo);

        $nuevoSponsor = new Sponsor([
            'CIF' => $request->input('cif'),
            'nombre' => $request->input('nombre'),
            'logo' => $nombreArchivo, 
            'calle' => $request->input('calle'),
            'destacado' => $request->input('destacado'),
            'activo' => true, 
        ]);

        $nuevoSponsor->save();

        return redirect()->route('sponsor.nuevo');
    }

    public function mostrarSponsors()
    {
        $sponsors = Sponsor::all();
        return view('admin.AdminSponsors', compact('sponsors'));
    }
}
