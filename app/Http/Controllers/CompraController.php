<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Proveedor;
use App\Models\Product;
use App\Models\DetalleCompra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('proveedor', 'detalleCompras')->get();
        return view('compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedor::all();
        $productos = Product::all();
        return view('compras.create', compact('proveedores', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'num_factura' => 'required|unique:compras',
            'proveedor' => 'required|exists:proveedores,id',
            'fecha' => 'required|date',
            'estado' => 'required|in:PENDIENTE,COMPLETADA,CANCELADA'
        ]);

        $compra = Compra::create([
            'num_factura' => $request->num_factura,
            'proveedor' => $request->proveedor,
            'fecha' => $request->fecha,
            'total' => 0,
            'estado' => $request->estado
        ]);

        // Procesar detalles
        if ($request->has('productos')) {
            $total = 0;
            foreach ($request->productos as $idx => $producto_id) {
                $cantidad = $request->cantidades[$idx];
                $costo_u = $request->costos[$idx];
                $subtotal = $cantidad * $costo_u;

                DetalleCompra::create([
                    'id_compras' => $compra->id,
                    'id_producto' => $producto_id,
                    'cantidad' => $cantidad,
                    'costo_u' => $costo_u,
                    'subtotal' => $subtotal
                ]);

                $total += $subtotal;

                // Actualizar stock del producto
                $producto = Product::find($producto_id);
                $producto->stock_actual += $cantidad;
                $producto->save();
            }

            $compra->update(['total' => $total]);
        }

        return redirect()->route('compras.index')
                        ->with('success', 'Compra registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $compra = Compra::with('proveedor', 'detalleCompras.producto')->findOrFail($id);
        return view('compras.show', compact('compra'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $compra = Compra::findOrFail($id);
        $proveedores = Proveedor::all();
        $productos = Product::all();
        return view('compras.edit', compact('compra', 'proveedores', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $compra = Compra::findOrFail($id);

        $request->validate([
            'num_factura' => 'required|unique:compras,num_factura,'.$id,
            'proveedor' => 'required|exists:proveedores,id',
            'fecha' => 'required|date',
            'estado' => 'required|in:PENDIENTE,COMPLETADA,CANCELADA'
        ]);

        $compra->update($request->all());

        return redirect()->route('compras.index')
                        ->with('success', 'Compra actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $compra = Compra::findOrFail($id);
        $compra->detalleCompras()->delete();
        $compra->delete();

        return redirect()->route('compras.index')
                        ->with('success', 'Compra eliminada exitosamente.');
    }
}
