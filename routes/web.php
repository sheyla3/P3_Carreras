<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JineteController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\AseguradoraController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\UsuarioController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|Route::get('/', function () {
    return view('welcome');
});

Route::get('/peliculas/{titulo}', function ($titulo) {
    return view('peliculas', array('titulo' => $titulo));
});

*/

// INICIO
Route::get('/', function () {
    return view('index');
})->name('/');


// USUARIO
Route::post('/loginUser', [UsuarioController::class, 'loginUsuario'])->name('loginUser');
Route::post('/registroUsuario', [UsuarioController::class, 'registroUsuario'])->name('registroUsuario');

//mostrar tickets
Route::get('/tickets', [CarrerasController::class, 'mostrarCarrerasClientes'])->name('tickets');
Route::get('/tickets', function () {return view('Enlaces.tickets');})->name('tickets');

// ADMIN
Route::get('/loginAdmin', function () {return view('Admin.loginAdmin');})->name('loginAdmin');
Route::post('/admin-iniciar', [AdminController::class, 'AdminIniciar'])->name('admin.iniciar');
Route::get('/Admin_panel', [AdminController::class, 'Admin_panelCarreras'])->name('Admin_panel');
Route::post('/admin-cerrar', [AdminController::class, 'CerrarSesion'])->name('admin.cerrar');

// socios
Route::get('/adminSocio', [SocioController::class, 'mostrarSocio'])->name('adminSocio');
Route::get('/formularioSocio', [SocioController::class, 'formularioSocio'])->name('formularioSocio');
Route::post('/guardarSocio', [SocioController::class, 'guardarSocio'])->name('guardar.socio');


//jinetes
Route::get('/formularioJinete', [JineteController::class, 'formularioJinete'])->name('formularioJinete');
Route::post('/jinete-nuevo', [JineteController::class, 'nuevo'])->name('jinete.nuevo');
Route::get('/editarJinete/{id}', [JineteController::class, 'editarJinete'])->name('editarJinete');
Route::post('/jinete-editar/{id}', [JineteController::class, 'editar'])->name('jinete.editar');
Route::get('/adminJinetes', [JineteController::class, 'mostrarJinetes'])->name('adminJinetes');
Route::put('/cambiarActivo/{id}', [JineteController::class, 'cambiarActivo'])->name('cambiarActivo');

//sponsors
Route::get('/formularioSponsor', [SponsorController::class, 'formularioSponsor'])->name('formularioSponsor');
Route::get('/adminSponsors', [SponsorController::class, 'mostrarSponsors'])->name('adminSponsors');
Route::post('/sponsor-nuevo', [SponsorController::class, 'nuevo'])->name('sponsor.nuevo');
Route::get('/editarSponsor/{id}', [SponsorController::class, 'editarSponsor'])->name('editarSponsor');
Route::post('/sponsor-editar/{id}', [SponsorController::class, 'editar'])->name('sponsor.editar');
Route::put('/cambiarActivo/{id}', [SponsorController::class, 'cambiarActivo'])->name('cambiarActivo');

//carreras
Route::get('/carreras/create', [CarrerasController::class, 'create'])->name('carreras.create');
Route::post('/carreras', [CarrerasController::class, 'store'])->name('carreras.store');
Route::get('/admin/carreras', [CarrerasController::class, 'carreras'])->name('admin.carreras');
Route::get('/AdminCarreras', [CarrerasController::class, 'mostrarCarreras'])->name('AdminCarreras');
Route::get('/editarCarrera/{id}', [CarrerasController::class, 'editarCarrera'])->name('editarCarrera');
Route::post('/carreras-editar/{id}', [CarrerasController::class, 'editar'])->name('carreras.editar');
Route::put('/cambiarActivo/{id}', [CarrerasController::class, 'cambiarActivo'])->name('cambiarActivo');
Route::get('/patrocinioCarrera/{id}', [CarrerasController::class, 'patrocinioCarrera'])->name('patrocinioCarrera');
Route::post('/carrera-patrocinio/{id}', [CarrerasController::class, 'nuevoPatrocinio'])->name('carrera.patrocinio');

//aseguradoras
Route::get('/formularioAseguradora', [AseguradoraController::class, 'formularioAseguradora'])->name('formularioAseguradora');
Route::post('/aseguradora-nuevo', [AseguradoraController::class, 'nuevo'])->name('aseguradora.nuevo');
Route::get('/adminAseguradoras', [AseguradoraController::class, 'mostrarAseguradoras'])->name('adminAseguradoras');
Route::get('/editarAseguradora/{id}', [AseguradoraController::class, 'editarAseguradora'])->name('editarAseguradora');
Route::post('/aseguradora-editar/{id}', [AseguradoraController::class, 'editar'])->name('aseguradora.editar');
Route::put('/cambiarActivo/{id}', [AseguradoraController::class, 'cambiarActivo'])->name('cambiarActivo');