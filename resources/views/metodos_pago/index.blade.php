@extends('layouts.app')

@section('title', 'Métodos de Pago')
@section('page_title', 'Gestión de Métodos de Pago')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-credit-card"></i> Métodos de Pago</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('metodos_pago.create') }}" class="btn btn-primary btn-custom">
            <i class="bi bi-plus-circle"></i> Nuevo Método
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($metodos_pago->count())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Recargo (%)</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($metodos_pago as $metodo)
                            <tr>
                                <td>{{ $metodo->id_met }}</td>
                                <td>{{ $metodo->nombre }}</td>
                                <td>{{ $metodo->recargo }}%</td>
                                <td>
                                    <span class="badge @if($metodo->activo) bg-success @else bg-danger @endif">
                                        @if($metodo->activo) Activo @else Inactivo @endif
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('metodos_pago.edit', $metodo->id_met) }}" class="btn btn-sm btn-warning btn-custom">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form method="POST" action="{{ route('metodos_pago.destroy', $metodo->id_met) }}" class="d-inline">
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
                <p class="text-muted mt-3">No hay métodos de pago registrados</p>
                <a href="{{ route('metodos_pago.create') }}" class="btn btn-primary btn-custom">Crear el primer método</a>
            </div>
        @endif
    </div>
</div>
@endsection
