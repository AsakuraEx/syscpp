<?php

use App\Http\Controllers\AutenticacionController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\PagosController;
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

//RUTAS PARA EL INICIO DE SESION
Route::get('/login', [AutenticacionController::class, 'mostrarLogin'])->name('mostrarLogin');
Route::post('/login', [AutenticacionController::class, 'login'])->name('login');
Route::post('/logout', [AutenticacionController::class, 'logout'])->name('logout');
Route::get('/registrarse', [AutenticacionController::class, 'registrarse'])->name('registrarse');
Route::post('/registrarse', [AutenticacionController::class, 'guardarRegistro'])->name('guardarRegistro');



Route::get('/usuarios', [AutenticacionController::class, 'index'])->name('usuarios.index');
Route::post('/usuarios', [AutenticacionController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/create', [AutenticacionController::class, 'create'])->name('usuarios.create');
Route::get('/usuarios/edit/{usuario}', [AutenticacionController::class, 'edit'])->name('usuarios.edit');
Route::patch('/usuarios/edit/{usuario}', [AutenticacionController::class, 'update'])->name('usuarios.update');
Route::patch('/usuarios/{usuario}', [AutenticacionController::class, 'cambiarEstado'])->name('cambiarEstado');
Route::get('/usuarios/busqueda', [AutenticacionController::class, 'buscarUsuario'])->name('buscarUsuario');

//RUTAS DEL SISTEMA

Route::get('/', function () {
    return view('home');
})->middleware('roles:1,2,3')->name('home');

Route::get('/facturas/busqueda', [FacturasController::class, 'buscarFactura'])->middleware('roles:1,2,3')->name('buscarFactura');

Route::resource('/facturas',FacturasController::class)->middleware('roles:1,2,3');

Route::get('/dashboard', [FacturasController::class, 'viewDashboard'])->middleware('roles:1,2')->name('dashboard');

Route::get('/pagos/busqueda', [PagosController::class, 'buscarPago'])->middleware('roles:1,2,3')->name('buscarPago');

Route::resource('/pagos', PagosController::class)->middleware('roles:1,2,3');

Route::get('/ranking-proveedores', [ProveedoresController::class, 'rankingProveedores'])->middleware('roles:1,2')->name('proveedores.ranking');

Route::get('/proveedores/busqueda', [ProveedoresController::class, 'buscarProveedor'])->middleware('roles:1,2,3')->name('buscarProveedor');

Route::resource('/proveedores', ProveedoresController::class)->middleware('roles:1,2,3');


