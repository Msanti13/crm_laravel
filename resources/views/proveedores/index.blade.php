@extends('layouts.app')

@section('title', 'Proveedores')
@section('page_title', 'Gestión de Proveedores')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-shop"></i> Proveedores</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('proveedores.create') }}" class="btn btn-primary btn-custom">
            <i class="bi bi-plus-circle"></i> Nuevo Proveedor
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($proveedores->count())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proveedores as $proveedor)
                            <tr>
                                <td>{{ $proveedor->id }}</td>
                                <td>{{ $proveedor->nombre }}</td>
                                <td>{{ $proveedor->email }}</td>
                                <td>{{ $proveedor->telefono }}</td>
                                <td>{{ $proveedor->direccion }}</td>
                                <td>
                                    <a href="{{ route('proveedores.edit', $proveedor->id) }}" class="btn btn-sm btn-warning btn-custom">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form method="POST" action="{{ route('proveedores.destroy', $proveedor->id) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-custom" onclick="return confirm('¿Estás seguro?')">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-inbox" style="font-size: 3rem; color: #ccc;"></i>
                <p class="text-muted mt-3">No hay proveedores registrados</p>
                <a href="{{ route('proveedores.create') }}" class="btn btn-primary btn-custom">Crear el primer proveedor</a>
            </div>
        @endif
    </div>
</div>
@endsection
