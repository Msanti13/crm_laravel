<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:200',
            'email' => 'required|email|unique:proveedores',
            'telefono' => 'required|string|max:10',
            'direccion' => 'required|string|max:200'
        ]);

        Proveedor::create($request->all());

        return redirect()->route('proveedores.index')
                        ->with('success', 'Proveedor creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        return view('proveedores.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('proveedores.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:200',
            'email' => 'required|email|unique:proveedores,email,'.$id,
            'telefono' => 'required|string|max:10',
            'direccion' => 'required|string|max:200'
        ]);

        $proveedor->update($request->all());

        return redirect()->route('proveedores.index')
                        ->with('success', 'Proveedor actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();

        return redirect()->route('proveedores.index')
                        ->with('success', 'Proveedor eliminado exitosamente.');
    }
}
