<?php

use App\Http\Controllers\FacturasController;
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


Route::resource('/facturas',FacturasController::class);

Route::get('/dashboard', [FacturasController::class, 'viewDashboard'])->name('dashboard');
