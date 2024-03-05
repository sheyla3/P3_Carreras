<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JineteController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\CarrerasController;
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
Route::get('/NuevoJinete', function () {
    return view('Admin.Formularios.NuevoJinete');
})->name('NuevoJinete');
Route::post('/jinete-nuevo', [JineteController::class, 'nuevo'])->name('jinete.nuevo');
Route::get('/AdminJinetes', [JineteController::class, 'mostrarJinetes'])->name('AdminJinetes');

//sponsors
Route::get('/NuevoSponsor', function () {
    return view('Admin.Formularios.NuevoSponsor');
})->name('NuevoSponsor');
Route::get('/AdminSponsors', [SponsorController::class, 'mostrarSponsors'])->name('AdminSponsors');
Route::post('/sponsor-nuevo', [SponsorController::class, 'nuevo'])->name('sponsor.nuevo');


Route::get('/carreras/create', [CarrerasController::class, 'create'])->name('carreras.create');
Route::post('/carreras', [CarrerasController::class, 'store'])->name('carreras.store');
Route::get('/admin/carreras', [CarrerasController::class, 'carreras'])->name('admin.carreras');
Route::get('/AdminJinetes', [JineteController::class, 'mostrarJinetes'])->name('AdminJinetes');
// USUARIO