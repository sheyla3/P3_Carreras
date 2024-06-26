<?php

namespace App\Http\Controllers;

use App\Models\Jinete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class JineteController extends Controller
{
    public function nuevo(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required',
            'contra' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'telf' => 'required',
            'calle' => 'required',
            'num_fede' => 'required',
            'edad' => 'required',
        ]);

                // Generar dorsal aleatorio del 1 al 50
                $dorsalAleatorio = rand(1, 50);

        if ($request->hasFile('foto')) {
            $rutaArchivo = $request->file('foto')->store('JinetesFoto', 'public');
        }
        try {
            $nuevoJinete = new Jinete();
            $nuevoJinete->nombre = $request->input('nombre');
            $nuevoJinete->apellido = $request->input('apellido');
            $nuevoJinete->correo = $request->input('correo');
            $nuevoJinete->contrasena = Hash::make($request->input('contra'));
            $nuevoJinete->foto = $rutaArchivo;
            $nuevoJinete->telf = $request->input('telf');
            $nuevoJinete->calle = $request->input('calle');
            $nuevoJinete->num_federat = $request->input('num_fede');
            $nuevoJinete->edad = $request->input('edad');
            $nuevoJinete->dorsal = $dorsalAleatorio;
            $nuevoJinete->activo = true;
            $nuevoJinete->save();

            if (session()->has('admin_id') || session()->has('admin_name')) {
                return redirect()->route('formularioJinete')->with('Guardado', 'Jinete agregado exitosamente');
            } else {
                return redirect()->route('/');
            }

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['ERROR' => 'Hubo un problema al procesar la solicitud']);
        }
    }

    public function mostrarJinetes()
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $jinetes = Jinete::all();
        return view('admin.adminJinetes', compact('jinetes', 'adminId', 'adminName'));
    }

    public function formularioJinete()
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        return view('Admin.Formularios.NuevoJinete', compact('adminId', 'adminName'));
    }

    public function editarJinete($id)
    {
        if (!session()->has('admin_id') || !session()->has('admin_name')) {
            return redirect()->route('loginAdmin')->with('ERROR', 'Debes iniciar sesión primero');
        }

        $adminId = session('admin_id');
        $adminName = session('admin_name');
        $jinete = Jinete::findOrFail($id);  // Obtener el jinete por su ID
        return view('Admin.Formularios.editarJinete', compact('jinete', 'adminId', 'adminName'));
    }

    public function editar(Request $request, $id)
    {
        $jinete = Jinete::find($id);
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required',
            'contra' => 'required',
            'telf' => 'required',
            'calle' => 'required',
            'num_fede' => 'required',
            'edad' => 'required',
        ]);

        $fechaNacimiento = \DateTime::createFromFormat('d/m/Y', $request->input('edad'))->format('Y-m-d');
        try {
            $jinete->update([
                'nombre' => $request->input('nombre'),
                'apellido' => $request->input('apellido'),
                'correo' => $request->input('correo'),
                'contrasena' => Hash::make($request->input('contra')),
                'telf' => $request->input('telf'),
                'calle' => $request->input('calle'),
                'num_federat' => $request->input('num_fede'),
                'edad' => $fechaNacimiento,
            ]);

            return redirect()->route('editarJinete', $id)->with('Editado', 'Jinete editado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['ERROR' => 'Hubo un problema al procesar la solicitud']);
        }
    }

    public function inactivo($id)
    {
        $jinete = Jinete::findOrFail($id);
        $jinete->activo = false;
        $jinete->save();
        
        return redirect()->route('adminJinetes')->with('success', 'El estado de la carrera ha sido actualizado correctamente.');
    }

    public function activo($id)
    {
        $jinete = Jinete::findOrFail($id);
        $jinete->activo = true;
        $jinete->save();

        return redirect()->route('adminJinetes');
    }

    public function loginJinete(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input("correo");
        $password = $request->input("password");

        $confUsu = Jinete::loginJinete($email);

        if ($confUsu && Hash::check($password, $confUsu->contrasena)) {
            session(['jinete_id' => $confUsu->id_jinete, 'jinete_name' => $confUsu->correo]);

            return redirect()->route('/');
        } else {
            return redirect()->back()->withErrors(['password' => 'La contraseña es incorrecta']);
        }
    }

    public function buscar(Request $request) {
        $search = $request->input('buscar');

        $jinetes = Jinete::where('nombre', 'LIKE', "%$search%")
                        ->orWhere('id_jinete', 'LIKE', "%$search%")
                        // ->orWhere('correo', 'LIKE', "%$search%")
                        ->get();

        return view('admin.adminJinetes', compact('jinetes'));
    }

}
