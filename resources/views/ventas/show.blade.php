@extends('layouts.app')

@section('title', 'Ver Venta')
@section('page_title', 'Detalles de la Venta')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-receipt"></i> Venta #{{ $venta->id }}</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('ventas.index') }}" class="btn btn-secondary btn-custom">
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
                <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
                <p><strong>Usuario:</strong> {{ $venta->usuario->nombre_usuario }}</p>
                <p><strong>Fecha:</strong> {{ $venta->fecha_emision->format('d/m/Y H:i') }}</p>
                <p><strong>Tipo Comprobante:</strong> {{ $venta->tipo_comprobante }}</p>
                <p><strong>Método de Pago:</strong> {{ $venta->metodoPago->nombre }}</p>
                <p><strong>Estado:</strong> 
                    <span class="badge @if($venta->estado == 'PAGADA') bg-success @elseif($venta->estado == 'PENDIENTE') bg-warning @else bg-danger @endif">
                        {{ $venta->estado }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card mb-3">
            <div class="card-header bg-light">
                <h5 class="mb-0">Datos del Cliente</h5>
            </div>
            <div class="card-body">
                <p><strong>NIT:</strong> {{ $venta->cliente->nit }}</p>
                <p><strong>Email:</strong> {{ $venta->cliente->email }}</p>
                <p><strong>Teléfono:</strong> {{ $venta->cliente->telefono }}</p>
                <p><strong>Dirección:</strong> {{ $venta->cliente->direccion }}</p>
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
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($venta->detalleVentas as $detalle)
                        <tr>
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                            <td>${{ number_format($detalle->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr class="table-light fw-bold">
                        <td colspan="3" class="text-end">TOTAL:</td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-custom">
        <i class="bi bi-pencil"></i> Editar
    </a>
    <form method="POST" action="{{ route('ventas.destroy', $venta->id) }}" class="d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-custom" onclick="return confirm('¿Estás seguro?')">
            <i class="bi bi-trash"></i> Eliminar
        </button>
    </form>
</div>
@endsection
