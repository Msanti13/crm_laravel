@extends('layouts.app')

@section('title', 'Productos')
@section('page_title', 'Gestión de Productos')

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h2><i class="bi bi-box"></i> Productos</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-custom">
            <i class="bi bi-plus-circle"></i> Nuevo Producto
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($products->count())
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Precio Compra</th>
                            <th>Precio Venta</th>
                            <th>Stock</th>
                            <th>Categoría</th>
                            <th>Proveedor</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->nombre }}</td>
                                <td>${{ number_format($product->precio_compra, 2) }}</td>
                                <td>${{ number_format($product->precio_venta, 2) }}</td>
                                <td>
                                    <span class="badge @if($product->stock_actual > 10) bg-success @elseif($product->stock_actual > 0) bg-warning @else bg-danger @endif">
                                        {{ $product->stock_actual }}
                                    </span>
                                </td>
                                <td>{{ $product->categoria->nombre ?? 'N/A' }}</td>
                                <td>{{ $product->proveedor->nombre ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge @if($product->estado) bg-success @else bg-secondary @endif">
                                        @if($product->estado) Activo @else Inactivo @endif
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-warning btn-custom">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}" class="d-inline">
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
                <p class="text-muted mt-3">No hay productos registrados</p>
                <a href="{{ route('products.create') }}" class="btn btn-primary btn-custom">Crear el primer producto</a>
            </div>
        @endif
    </div>
</div>
@endsection
