<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\MetodoPagoController;
use App\Http\Controllers\RolController;

Route::get('/', function () {
  return view('home');
});

// Rutas de Productos
Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/crear', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/editar', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

// Rutas de Categorías
Route::resource('categorias', CategoriaController::class);

// Rutas de Proveedores
Route::resource('proveedores', ProveedorController::class);

// Rutas de Clientes
Route::resource('clientes', ClienteController::class);

// Rutas de Compras
Route::resource('compras', CompraController::class);

// Rutas de Ventas
Route::resource('ventas', VentaController::class);

// Rutas de Métodos de Pago
Route::resource('metodos_pago', MetodoPagoController::class);

// Rutas de Roles
Route::resource('roles', RolController::class);