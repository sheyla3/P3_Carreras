<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarrerasController; // Agrega esta línea

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

Route::get('/NuevoJinete', function () {
    return view('Admin.Formularios.NuevoJinete');
})->name('NuevoJinete');

Route::post('/admin-iniciar', [AdminController::class, 'AdminIniciar'])->name('admin.iniciar');
Route::get('/Admin_panel', [AdminController::class, 'Admin_panelCarreras'])->name('Admin_panel');
Route::get('/carreras/create', [CarrerasController::class, 'create'])->name('carreras.create');
Route::post('/carreras', [CarrerasController::class, 'store'])->name('carreras.store');
Route::get('/admin/carreras', [CarrerasController::class, 'carreras'])->name('admin.carreras');

// USUARIO