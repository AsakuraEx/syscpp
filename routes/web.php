<?php

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

Route::get('/', function () {
    return view('home');
})->name('home');


Route::get('/facturas/busqueda', [FacturasController::class, 'buscarFactura'])->name('buscarFactura');

Route::resource('/facturas',FacturasController::class);

Route::get('/dashboard', [FacturasController::class, 'viewDashboard'])->name('dashboard');

Route::get('/pagos/busqueda', [PagosController::class, 'buscarPago'])->name('buscarPago');

Route::resource('/pagos', PagosController::class);

Route::get('/ranking-proveedores', [ProveedoresController::class, 'rankingProveedores'])->name('proveedores.ranking');

Route::get('/proveedores/busqueda', [ProveedoresController::class, 'buscarProveedor'])->name('buscarProveedor');

Route::resource('/proveedores', ProveedoresController::class);


