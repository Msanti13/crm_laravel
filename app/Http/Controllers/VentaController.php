<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\User;
use App\Models\MetodoPago;
use App\Models\Product;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with('cliente', 'usuario', 'metodoPago', 'detalleVentas')->get();
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $metodos_pago = MetodoPago::where('activo', true)->get();
        $productos = Product::where('estado', true)->get();
        return view('ventas.create', compact('clientes', 'metodos_pago', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente' => 'required|exists:clientes,id',
            'metodo_pago' => 'required|exists:metodos_pago,id_met',
            'tipo_comprobante' => 'required|in:FACTURA,BOLETA,NOTA_CREDITO',
            'estado' => 'required|in:PAGADA,PENDIENTE,CANCELADA'
        ]);

        $venta = Venta::create([
            'usuario' => Auth::id(),
            'cliente' => $request->cliente,
            'metodo_pago' => $request->metodo_pago,
            'tipo_comprobante' => $request->tipo_comprobante,
            'estado' => $request->estado,
            'total' => 0
        ]);

        // Procesar detalles
        if ($request->has('productos')) {
            $total = 0;
            foreach ($request->productos as $idx => $producto_id) {
                $cantidad = $request->cantidades[$idx];
                $precio_unitario = $request->precios[$idx];
                $subtotal = $cantidad * $precio_unitario;

                DetalleVenta::create([
                    'id_venta' => $venta->id,
                    'id_producto' => $producto_id,
                    'cantidad' => $cantidad,
                    'precio_unitario' => $precio_unitario,
                    'subtotal' => $subtotal
                ]);

                $total += $subtotal;

                // Actualizar stock del producto
                $producto = Product::find($producto_id);
                $producto->stock_actual -= $cantidad;
                $producto->save();
            }

            $venta->update(['total' => $total]);
        }

        return redirect()->route('ventas.index')
                        ->with('success', 'Venta registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $venta = Venta::with('cliente', 'usuario', 'metodoPago', 'detalleVentas.producto')->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        $clientes = Cliente::all();
        $metodos_pago = MetodoPago::where('activo', true)->get();
        $productos = Product::all();
        return view('ventas.edit', compact('venta', 'clientes', 'metodos_pago', 'productos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);

        $request->validate([
            'cliente' => 'required|exists:clientes,id',
            'metodo_pago' => 'required|exists:metodos_pago,id_met',
            'tipo_comprobante' => 'required|in:FACTURA,BOLETA,NOTA_CREDITO',
            'estado' => 'required|in:PAGADA,PENDIENTE,CANCELADA'
        ]);

        $venta->update($request->all());

        return redirect()->route('ventas.index')
                        ->with('success', 'Venta actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->detalleVentas()->delete();
        $venta->delete();

        return redirect()->route('ventas.index')
                        ->with('success', 'Venta eliminada exitosamente.');
    }
}
