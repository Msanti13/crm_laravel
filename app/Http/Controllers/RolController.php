<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|string|max:200|unique:roles'
        ]);

        Rol::create($request->all());

        return redirect()->route('roles.index')
                        ->with('success', 'Rol creado exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $rol = Rol::findOrFail($id);
        return view('roles.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rol = Rol::findOrFail($id);

        $request->validate([
            'nombres' => 'required|string|max:200|unique:roles,nombres,'.$id
        ]);

        $rol->update($request->all());

        return redirect()->route('roles.index')
                        ->with('success', 'Rol actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();

        return redirect()->route('roles.index')
                        ->with('success', 'Rol eliminado exitosamente.');
    }
}
