@extends('layouts.app')

@section('title', 'Clientes')
@section('page_title', 'Gestión de Clientes')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-people"></i> Clientes</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-custom">
            <i class="bi bi-plus-circle"></i> Nuevo Cliente
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($clientes->count())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>NIT</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->id }}</td>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->nit }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->direccion }}</td>
                                <td>
                                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-sm btn-warning btn-custom">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form method="POST" action="{{ route('clientes.destroy', $cliente->id) }}" class="d-inline">
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
                <p class="text-muted mt-3">No hay clientes registrados</p>
                <a href="{{ route('clientes.create') }}" class="btn btn-primary btn-custom">Crear el primer cliente</a>
            </div>
        @endif
    </div>
</div>
@endsection
