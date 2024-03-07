<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use Illuminate\Http\Request;

class CarrerasController extends Controller
{

    public function carreras()
    {

    }

    public function mostrarCarreras()
    {
        $carreras = Carrera::all();
        return view('admin.AdminCarreras', compact('carreras'));
    }

    public function mostrarCarrerasClientes()
    {
        $carreras = Carrera::all();
        return view('enlaces.tickets', compact('carreras'));
    }
    

    // Método para mostrar el formulario de creación de carreras
    public function create()
    {
        return view('admin.create');
    }
    
    // Método para guardar la carrera creada
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fechaHora' => 'required|date',
            'patrocinio' => 'required|integer',
            'precio' => 'required|integer', 
            // 'lugar_foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Corrige el nombre del campo a 'lugar_foto'
        ]);

        // // Manejar la imagen subida y guardarla en la carpeta storage/app/public/img
        // $imagePath = $request->file('lugar_foto')->store('public/img');

        // // Obtener la ruta relativa de la imagen guardada (incluyendo el prefijo 'public/')
        // $imageUrl = $imagePath;

        // Crear una nueva instancia de Carrera con los datos validados
        $carrera = new Carrera();
        $carrera->fill($validatedData);
        // $carrera->lugar_foto = $imageUrl;
        $carrera->km = 10; // Proporciona un valor para el campo km (o cualquier otro valor que desees)
        $carrera->fechaHora = $validatedData['fechaHora'];
        $carrera->patrocinio = $validatedData['patrocinio'];
        $carrera->precio = $validatedData['precio'];

        $carrera->save();

        // Redirigir a alguna vista después de guardar la carrera
        return redirect()->route('carreras.create')->with('Guardado', 'Carrera agregada exitosamente');
    }
}
