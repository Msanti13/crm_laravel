<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use Illuminate\Http\Request;

class MetodoPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $metodos_pago = MetodoPago::all();
        return view('metodos_pago.index', compact('metodos_pago'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('metodos_pago.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:metodos_pago',
            'recargo' => 'nullable|numeric|min:0',
            'activo' => 'boolean'
        ]);

        MetodoPago::create([
            'nombre' => $request->nombre,
            'recargo' => $request->recargo ?? 0,
            'activo' => $request->activo ?? true
        ]);

        return redirect()->route('metodos_pago.index')
                        ->with('success', 'Método de pago creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $metodo = MetodoPago::findOrFail($id);
        return view('metodos_pago.edit', compact('metodo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $metodo = MetodoPago::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:50|unique:metodos_pago,nombre,'.$id.',id_met',
            'recargo' => 'nullable|numeric|min:0',
            'activo' => 'boolean'
        ]);

        $metodo->update([
            'nombre' => $request->nombre,
            'recargo' => $request->recargo ?? 0,
            'activo' => $request->activo ?? true
        ]);

        return redirect()->route('metodos_pago.index')
                        ->with('success', 'Método de pago actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $metodo = MetodoPago::findOrFail($id);
        $metodo->delete();

        return redirect()->route('metodos_pago.index')
                        ->with('success', 'Método de pago eliminado exitosamente.');
    }
}
