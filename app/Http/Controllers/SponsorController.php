<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Dompdf\Dompdf;

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

    public function buscarSponsor(Request $request)    {

        $search = $request->input('buscar');

        $sponsors = Sponsor::where('nombre', 'LIKE', "%$search%")
                        ->orWhere('CIF', 'LIKE', "%$search%")
                        ->get();

        return view('admin.adminSponsors', compact('sponsors'));
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

    public function inactivo($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->activo = false;
        $sponsor->save();
        
        return redirect()->route('adminSponsors');
    }

    public function activo($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->activo = true;
        $sponsor->save();

        return redirect()->route('adminSponsors');
    }

    public function FacturaSponsor($id)
    {
        $sponsor = Sponsor::findOrFail($id);
        // Crea una instancia de Dompdf
        $pdf = new Dompdf();
        // Contenido HTML para el PDF
        $html = '<h1 style="text-align: center; ">' . $sponsor->nombre . '</h1>';
        $html = '<p class="text-break">' . $sponsor->id_sponsor . '</p>';
        $html .= '<style>';
        $html .= 'table { width: 100%; border-collapse: collapse; }';
        $html .= 'th, td { padding: 10px; text-align: center; }';
        $html .= 'thead { background-color: #423333; color: white; }';
        $html .= '</style>';
        $html .= '<table>';
        $html .= '<thead><tr><th>ID</th><th>Cantidad</th><th>Total</th></tr></thead>';
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td>' . $sponsor->id_sponsor . '</td>';
        $html .= '<td>' . $sponsor . '</td>';
        $html .= '<td>' . $sponsor . '</td>';
        $html .= '</tr>';
        $html .= '</tbody></table>';
        // Carga el HTML en Dompdf
        $pdf->loadHtml($html);
        // Renderiza el PDF
        $pdf->render();
        // Descarga el PDF
        return $pdf->stream('factura.pdf');
    }
}
