<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JineteController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\AseguradoraController;
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

Route::get('/hola', function () {
    //echo date('d-m-y');
    $titulo = '<h3>La data actual es: </h3>';
    return view('mostrarData', array('titulo' => $titulo));
});

Route::get('/peliculas/{titulo}', function ($titulo) {
    return view('peliculas', array('titulo' => $titulo));
});

*/

// INICIO
Route::get('/', function () {
    return view('index');
})->name('/');

// ADMIN
Route::get('/loginAdmin', function () {
    return view('Admin.loginAdmin');
})->name('loginAdmin');

Route::post('/admin-iniciar', [AdminController::class, 'AdminIniciar'])->name('admin.iniciar');
Route::get('/Admin_panel', [AdminController::class, 'Admin_panelCarreras'])->name('Admin_panel');

//jinetes
Route::get('/formularioJinete', [JineteController::class, 'formularioJinete'])->name('formularioJinete');
Route::post('/jinete-nuevo', [JineteController::class, 'nuevo'])->name('jinete.nuevo');
Route::get('/editarJinete/{id}', [JineteController::class, 'editarJinete'])->name('editarJinete');
Route::post('/jinete-editar/{id}', [JineteController::class, 'editar'])->name('jinete.editar');
Route::get('/adminJinetes', [JineteController::class, 'mostrarJinetes'])->name('adminJinetes');

//sponsors
Route::get('/formularioSponsor', [SponsorController::class, 'formularioSponsor'])->name('formularioSponsor');
Route::get('/adminSponsors', [SponsorController::class, 'mostrarSponsors'])->name('adminSponsors');
Route::post('/sponsor-nuevo', [SponsorController::class, 'nuevo'])->name('sponsor.nuevo');
Route::get('/editarSponsor/{id}', [SponsorController::class, 'editarSponsor'])->name('editarSponsor');
Route::post('/sponsor-editar/{id}', [SponsorController::class, 'editar'])->name('sponsor.editar');

//carreras
Route::get('/carreras/create', [CarrerasController::class, 'create'])->name('carreras.create');
Route::post('/carreras', [CarrerasController::class, 'store'])->name('carreras.store');
Route::get('/admin/carreras', [CarrerasController::class, 'carreras'])->name('admin.carreras');
Route::get('/AdminCarreras', [CarrerasController::class, 'mostrarCarreras'])->name('AdminCarreras');

//aseguradoras
Route::get('/formularioAseguradora', [AseguradoraController::class, 'formularioAseguradora'])->name('formularioAseguradora');
Route::post('/aseguradora-nuevo', [AseguradoraController::class, 'nuevo'])->name('aseguradora.nuevo');
Route::get('/adminAseguradoras', [AseguradoraController::class, 'mostrarAseguradoras'])->name('adminAseguradoras');
Route::get('/editarAseguradora/{id}', [AseguradoraController::class, 'editarAseguradora'])->name('editarAseguradora');
Route::post('/aseguradora-editar/{id}', [AseguradoraController::class, 'editar'])->name('aseguradora.editar');

// USUARIO
