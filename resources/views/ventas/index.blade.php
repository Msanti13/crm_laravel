@extends('layouts.app')

@section('title', 'Ventas')
@section('page_title', 'Gestión de Ventas')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-cart-check"></i> Ventas</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('ventas.create') }}" class="btn btn-primary btn-custom">
            <i class="bi bi-plus-circle"></i> Nueva Venta
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($ventas->count())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Tipo Comprobante</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventas as $venta)
                            <tr>
                                <td>{{ $venta->id }}</td>
                                <td>{{ $venta->cliente->nombre ?? 'N/A' }}</td>
                                <td>{{ $venta->usuario->nombre_usuario ?? 'N/A' }}</td>
                                <td>{{ $venta->fecha_emision->format('d/m/Y H:i') }}</td>
                                <td>{{ $venta->tipo_comprobante }}</td>
                                <td><strong>${{ number_format($venta->total, 2) }}</strong></td>
                                <td>
                                    <span class="badge @if($venta->estado == 'PAGADA') bg-success @elseif($venta->estado == 'PENDIENTE') bg-warning @else bg-danger @endif">
                                        {{ $venta->estado }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-sm btn-info btn-custom">
                                        <i class="bi bi-eye"></i> Ver
                                    </a>
                                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-sm btn-warning btn-custom">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form method="POST" action="{{ route('ventas.destroy', $venta->id) }}" class="d-inline">
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
                <p class="text-muted mt-3">No hay ventas registradas</p>
                <a href="{{ route('ventas.create') }}" class="btn btn-primary btn-custom">Registrar la primera venta</a>
            </div>
        @endif
    </div>
</div>
@endsection
