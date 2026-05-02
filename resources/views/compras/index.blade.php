@extends('layouts.app')

@section('title', 'Compras')
@section('page_title', 'Gestión de Compras')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-cart-plus"></i> Compras</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('compras.create') }}" class="btn btn-primary btn-custom">
            <i class="bi bi-plus-circle"></i> Nueva Compra
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($compras->count())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nº Factura</th>
                            <th>Proveedor</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compras as $compra)
                            <tr>
                                <td>{{ $compra->id }}</td>
                                <td>{{ $compra->num_factura }}</td>
                                <td>{{ $compra->proveedor->nombre ?? 'N/A' }}</td>
                                <td>{{ $compra->fecha->format('d/m/Y') }}</td>
                                <td>${{ number_format($compra->total, 2) }}</td>
                                <td>
                                    <span class="badge @if($compra->estado == 'COMPLETADA') bg-success @elseif($compra->estado == 'PENDIENTE') bg-warning @else bg-danger @endif">
                                        {{ $compra->estado }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('compras.show', $compra->id) }}" class="btn btn-sm btn-info btn-custom">
                                        <i class="bi bi-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-sm btn-warning btn-custom">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form method="POST" action="{{ route('compras.destroy', $compra->id) }}" class="d-inline">
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
                <p class="text-muted mt-3">No hay compras registradas</p>
                <a href="{{ route('compras.create') }}" class="btn btn-primary btn-custom">Registrar la primera compra</a>
            </div>
        @endif
    </div>
</div>
@endsection
