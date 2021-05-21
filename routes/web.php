<?php

use App\Http\Controllers\CompradorController;
use App\Http\Controllers\EmisorController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('facturas',FacturaController::class)->middleware('auth');
Route::get('/listarFacturas', [FacturaController::class, 'listarFacturas'])->name('listarFacturas');
Route::get('/listarEmisores', [EmisorController::class, 'index'])->name('listarEmisores');
Route::get('/listarCompradores', [CompradorController::class, 'index'])->name('listarCompradores');
Route::get('/listarProductos', [ProductosController::class, 'index'])->name('listarProductos');
