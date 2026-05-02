@extends('layouts.app')

@section('title', 'Categorías')
@section('page_title', 'Gestión de Categorías')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-tags"></i> Categorías</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-custom">
            <i class="bi bi-plus-circle"></i> Nueva Categoría
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($categorias->count())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->id }}</td>
                                <td>{{ $categoria->nombre }}</td>
                                <td>
                                    <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-warning btn-custom">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form method="POST" action="{{ route('categorias.destroy', $categoria->id) }}" class="d-inline">
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
                <p class="text-muted mt-3">No hay categorías registradas</p>
                <a href="{{ route('categorias.create') }}" class="btn btn-primary btn-custom">Crear la primera categoría</a>
            </div>
        @endif
    </div>
</div>
@endsection
