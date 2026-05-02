@extends('layouts.app')

@section('title', 'Ver Compra')
@section('page_title', 'Detalles de la Compra')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-receipt"></i> Compra #{{ $compra->id }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('compras.index') }}" class="btn btn-secondary btn-custom">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">Información General</h5>
            </div>
            <div class="card-body">
                <p><strong>Número de Factura:</strong> {{ $compra->num_factura }}</p>
                <p><strong>Proveedor:</strong> {{ $compra->proveedor->nombre }}</p>
                <p><strong>Fecha:</strong> {{ $compra->fecha->format('d/m/Y') }}</p>
                <p><strong>Estado:</strong> 
                    <span class="badge @if($compra->estado == 'COMPLETADA') bg-success @elseif($compra->estado == 'PENDIENTE') bg-warning @else bg-danger @endif">
                        {{ $compra->estado }}
                    </span>
                </p>
                <p><strong>Total:</strong> <span class="h5 text-primary">${{ number_format($compra->total, 2) }}</span></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">Datos del Proveedor</h5>
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $compra->proveedor->email }}</p>
                <p><strong>Teléfono:</strong> {{ $compra->proveedor->telefono }}</p>
                <p><strong>Dirección:</strong> {{ $compra->proveedor->direccion }}</p>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-light">
        <h5 class="mb-0">Detalle de Productos</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Costo Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($compra->detalleCompras as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->costo_u, 2) }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="table-light fw-bold">
                        <td colspan="3" class="text-end">TOTAL:</td>
                        <td>${{ number_format($compra->total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('compras.edit', $compra->id) }}" class="btn btn-warning btn-custom">
        <i class="bi bi-pencil"></i> Editar
    </a>
    <form method="POST" action="{{ route('compras.destroy', $compra->id) }}" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-custom" onclick="return confirm('¿Estás seguro?')">
            <i class="bi bi-trash"></i> Eliminar
        </button>
    </form>
</div>
@endsection
