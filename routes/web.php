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
Auth::routes();



//RUTAS PROTEGIDAS CON AUTENTICACION DE usuario
Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::resource('facturas',FacturaController::class)->middleware('auth');
Route::get('/listarFacturas', [FacturaController::class, 'listarFacturas'])->name('listarFacturas')->middleware('auth');//VISTA DONDE MUESTRA LAS FACTURAS REALIZADAS
Route::get('listarEmisores', [EmisorController::class, 'index'])->name('listarEmisores')->middleware('auth');//VISTA PARA CARGAR TODOS LOS EMISORES
Route::get('listarCompradores', [CompradorController::class, 'index'])->name('listarCompradores')->middleware('auth');//VISTA PARA CARGAR TODOS LOS COMPRADORES
Route::get('listarProductos', [ProductosController::class, 'index'])->name('listarProductos')->middleware('auth');//VISTA PARA CARGAR TODOS LOS PRODUCTOR
