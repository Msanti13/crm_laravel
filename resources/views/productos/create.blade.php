@extends('layouts.app')

@section('title', 'Crear Producto')
@section('page_title', 'Crear Nuevo Producto')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Formulario de Producto</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select class="form-select @error('categoria') is-invalid @enderror" 
                                    id="categoria" name="categoria" required>
                                <option value="">Selecciona una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @if(old('categoria') == $categoria->id) selected @endif>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categoria')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="proveedor" class="form-label">Proveedor</label>
                            <select class="form-select @error('proveedor') is-invalid @enderror" 
                                    id="proveedor" name="proveedor" required>
                                <option value="">Selecciona un proveedor</option>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" @if(old('proveedor') == $proveedor->id) selected @endif>
                                        {{ $proveedor->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('proveedor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="stock_actual" class="form-label">Stock Inicial</label>
                            <input type="number" class="form-control @error('stock_actual') is-invalid @enderror" 
                                   id="stock_actual" name="stock_actual" value="{{ old('stock_actual', 0) }}" min="0" required>
                            @error('stock_actual')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="precio_compra" class="form-label">Precio de Compra</label>
                            <input type="number" step="0.01" class="form-control @error('precio_compra') is-invalid @enderror" 
                                   id="precio_compra" name="precio_compra" value="{{ old('precio_compra') }}" min="0" required>
                            @error('precio_compra')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="precio_venta" class="form-label">Precio de Venta</label>
                            <input type="number" step="0.01" class="form-control @error('precio_venta') is-invalid @enderror" 
                                   id="precio_venta" name="precio_venta" value="{{ old('precio_venta') }}" min="0" required>
                            @error('precio_venta')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="estado" name="estado" value="1" checked>
                        <label class="form-check-label" for="estado">Producto Activo</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="bi bi-save"></i> Guardar Producto
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-custom">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
