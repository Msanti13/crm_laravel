<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ChirpController;


Route::get('/', function () {
  return view('home');
});

//Route::get('/productos', [ProductoController::class, 'index']);
//Route::view('/productos', 'producto'); // Usando una vista directamente
Route::get('products', [ProductController::class, 'index'])->name('products.index'); // Usando un controlador de recurso completo
Route::get('/products/crear', [ProductController::class, 'create'])->name('products.create'); // Ruta para crear un producto
Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Ruta para almacenar un producto
Route::get('/products/{id}/editar', [ProductController::class, 'edit'])->name('products.edit'); // Ruta para editar un producto
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Ruta para actualizar un producto
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Ruta para eliminar un producto