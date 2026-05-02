<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Proveedor;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('categoria', 'proveedor')->get();
        return view('productos.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('productos.create', compact('categorias', 'proveedores'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:200',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'categoria' => 'required|exists:categorias,id',
            'proveedor' => 'required|exists:proveedores,id',
            'estado' => 'required|boolean'
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('categoria', 'proveedor')->findOrFail($id);
        return view('productos.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('productos.edit', compact('product', 'categorias', 'proveedores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:200',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'categoria' => 'required|exists:categorias,id',
            'proveedor' => 'required|exists:proveedores,id',
            'estado' => 'required|boolean'
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
                         ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')
                         ->with('success', 'Producto eliminado exitosamente.');
    }
}
