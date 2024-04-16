<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\JineteController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\CarrerasController;
use App\Http\Controllers\FotosController;
use App\Http\Controllers\AseguradoraController;
use App\Http\Controllers\SocioController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\PerfilController;


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
Route::get('/', [CarrerasController::class, 'index2'])->name('/');


// USUARIOS: Socios / Jinetes
Route::post('/loginJinete', [JineteController::class, 'loginJinete'])->name('loginJinete');
Route::post('/loginUser', [UsuarioController::class, 'loginUsuario'])->name('loginUser');
Route::post('/registroUsuario', [UsuarioController::class, 'registroUsuario'])->name('registroUsuario');
Route::post('/usuario-cerrar', [UsuarioController::class, 'cerrarSesion'])->name('usuario.cerrar');

//TICKETS: mostrar tickets
Route::get('/tickets', [CarrerasController::class, 'mostrarCarrerasClientes'])->name('tickets');
Route::get('/listaJinetes/{id}', [CarrerasController::class, 'listaJinetes'])->name('listaJinetes');
Route::get('/factura/{subtotal}/{total_quantity}/{carrera_id}', [CarrerasController::class, 'FacturaPDF'])->name('FacturaPDF');

//RECORD: mostrar carreras antiguas
Route::get('/record', [CarrerasController::class, 'mostrarCarrerasAntiguas'])->name('record');
Route::get('/carreraAntigua/{id}', [CarrerasController::class, 'carreraAntigua'])->name('carreraAntigua');
Route::get('/ClasiPDF/{id}', [CarrerasController::class, 'ImprimirClasiPDF'])->name('ClasiPDF');

//CARRERAS: mostrar carreras posteriores
Route::get('/carreras', [CarrerasController::class, 'mostrarCarrerasJinetes'])->name('carreras');
Route::get('/inscribirse/{id_carrera}/{id_jinete}', [CarrerasController::class, 'inscribirse'])->name('inscribirse');
Route::get('/desinscribirse/{id_carrera}/{id_jinete}', [CarrerasController::class, 'desinscribirse'])->name('desinscribirse');

// QR
Route::get('qr/{id_carrera}/{id_jinete}/{dorsal}/{fechaHora}', 'QRController@generarQR');



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
Route::get('/inactivo-jinete/{id}', [JineteController::class, 'inactivo'])->name('inactivoJinete');
Route::get('/activo-jinete/{id}', [JineteController::class, 'activo'])->name('activoJinete');

//sponsors
Route::get('/formularioSponsor', [SponsorController::class, 'formularioSponsor'])->name('formularioSponsor');
Route::get('/adminSponsors', [SponsorController::class, 'mostrarSponsors'])->name('adminSponsors');
Route::post('/sponsor-nuevo', [SponsorController::class, 'nuevo'])->name('sponsor.nuevo');
Route::get('/editarSponsor/{id}', [SponsorController::class, 'editarSponsor'])->name('editarSponsor');
Route::post('/sponsor-editar/{id}', [SponsorController::class, 'editar'])->name('sponsor.editar');
Route::get('/inactivo-sponsor/{id}', [SponsorController::class, 'inactivo'])->name('inactivoSponsor');
Route::get('/activo-sponsor/{id}', [SponsorController::class, 'activo'])->name('activoSponsor');
Route::get('/facturaSponsor/{id}', [SponsorController::class, 'FacturaSponsor'])->name('FacturaSponsor');

//carreras
Route::get('/carreras-create', [CarrerasController::class, 'create'])->name('carreras.create');
Route::post('/carreras-store', [CarrerasController::class, 'store'])->name('carreras.store');
Route::get('/AdminCarreras', [CarrerasController::class, 'mostrarCarreras'])->name('AdminCarreras');
Route::get('/editarCarrera/{id}', [CarrerasController::class, 'editarCarrera'])->name('editarCarrera');
Route::post('/carrera-editar/{id}', [CarrerasController::class, 'editar'])->name('carrera.editar');
Route::get('/patrocinioCarrera/{id}', [CarrerasController::class, 'patrocinioCarrera'])->name('patrocinioCarrera');
Route::post('/carrera-patrocinio/{id}', [CarrerasController::class, 'nuevoPatrocinio'])->name('carrera.patrocinio');
Route::get('/inactivo-carrera/{id}', [CarrerasController::class, 'inactivo'])->name('inactivoCarrera');
Route::get('/activo-carrera/{id}', [CarrerasController::class, 'activo'])->name('activoCarrera');
Route::get('/facturaSponsorCarrera/{id}', [CarrerasController::class, 'FacturaSponsorCarrera'])->name('FacturaSponsorCarrera');

//aseguradoras
Route::get('/formularioAseguradora', [AseguradoraController::class, 'formularioAseguradora'])->name('formularioAseguradora');
Route::post('/aseguradora-nuevo', [AseguradoraController::class, 'nuevo'])->name('aseguradora.nuevo');
Route::get('/adminAseguradoras', [AseguradoraController::class, 'mostrarAseguradoras'])->name('adminAseguradoras');
Route::get('/editarAseguradora/{id}', [AseguradoraController::class, 'editarAseguradora'])->name('editarAseguradora');
Route::post('/aseguradora-editar/{id}', [AseguradoraController::class, 'editar'])->name('aseguradora.editar');
Route::get('/inactivo-aseguradora/{id}', [AseguradoraController::class, 'inactivo'])->name('inactivoAseguradora');
Route::get('/activo-aseguradora/{id}', [AseguradoraController::class, 'activo'])->name('activoAseguradora');

//fotos
Route::get('/adminFotos', [FotosController::class, 'mostrarFotos'])->name('adminFotos');
Route::post('/anadirFoto', [FotosController::class, 'anadirFoto'])->name('anadirFoto');
Route::get('/verFotos/{id}', [FotosController::class, 'verFotos'])->name('verFotos');
Route::get('/eliminarFoto/{id}', [FotosController::class, 'eliminarFoto'])->name('eliminarFoto');
Route::get('/eliminarTodasFotos/{id}', [FotosController::class, 'eliminarTodasFotos'])->name('eliminarTodasFotos');

//perfil
Route::get('/perfil/{id}', [PerfilController::class, 'mostrarPerfil'])->name('perfil.mostrar');
