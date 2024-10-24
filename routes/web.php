<?php

use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProveedoresController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//RUTAS DEL SISTEMA

Route::get('/', function () {
    return view('home');
})->middleware('roles:1,2,3')->name('home');


// USUARIOS
Route::get('/usuarios', [AutenticacionController::class, 'index'])->middleware('roles:1')->name('usuarios.index');
Route::post('/usuarios', [AutenticacionController::class, 'store'])->middleware('roles:1')->name('usuarios.store');
Route::get('/usuarios/create', [AutenticacionController::class, 'create'])->middleware('roles:1')->name('usuarios.create');
Route::get('/usuarios/busqueda', [AutenticacionController::class, 'buscarUsuario'])->middleware('roles:1')->name('buscarUsuario');
Route::get('/usuarios/edit/{usuario}', [AutenticacionController::class, 'edit'])->middleware('roles:1')->name('usuarios.edit');
Route::patch('/usuarios/edit/{usuario}', [AutenticacionController::class, 'update'])->middleware('roles:1')->name('usuarios.update');
Route::patch('/usuarios/{usuario}', [AutenticacionController::class, 'cambiarEstado'])->middleware('roles:1')->name('cambiarEstado');
Route::get('/cambiar-contrasena', [AutenticacionController::class, 'password'])->middleware('roles:1,2,3')->name('usuarios.password');
Route::patch('/cambiar-contrasena', [AutenticacionController::class, 'changePassword'])->middleware('roles:1,2,3')->name('usuarios.changePassword');

//RUTAS PARA EL INICIO DE SESION
Route::get('/login', [AutenticacionController::class, 'mostrarLogin'])->name('mostrarLogin');
Route::post('/login', [AutenticacionController::class, 'login'])->name('login');
Route::post('/logout', [AutenticacionController::class, 'logout'])->name('logout');


//FACTURAS
Route::get('/facturas/busqueda', [FacturasController::class, 'buscarFactura'])->middleware('roles:1,2,3')->name('buscarFactura');
Route::resource('/facturas',FacturasController::class)->middleware('roles:1,2,3');

//Dashboard
Route::get('/dashboard', [FacturasController::class, 'viewDashboard'])->middleware('roles:1,2')->name('dashboard');

//Pagos
Route::get('/pagos/busqueda', [PagosController::class, 'buscarPago'])->middleware('roles:1,2,3')->name('buscarPago');
Route::resource('/pagos', PagosController::class)->middleware('roles:1,2,3');

//Proveedores
Route::get('/ranking-proveedores', [ProveedoresController::class, 'rankingProveedores'])->middleware('roles:1,2')->name('proveedores.ranking');
Route::get('/proveedores/busqueda', [ProveedoresController::class, 'buscarProveedor'])->middleware('roles:1,2,3')->name('buscarProveedor');
Route::resource('/proveedores', ProveedoresController::class)->middleware('roles:1,2,3');

//Reportes
Route::get('/reportes/facturaspdf', [PDFController::class, 'facturasPDF'])->name('facturasPDF');
Route::get('/reportes/rankingpdf', [PDFController::class, 'rankingPDF'])->name('rankingPDF');
Route::get('/reportes/pagospdf', [PDFController::class, 'rankingPDF'])->name('pagosPDF');


