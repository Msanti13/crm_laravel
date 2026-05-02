@extends('layouts.app')

@section('title', 'Editar Compra')
@section('page_title', 'Editar Compra #' . $compra->id)

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Editar Compra</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('compras.update', $compra->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="num_factura" class="form-label">Número de Factura</label>
                            <input type="number" class="form-control @error('num_factura') is-invalid @enderror" 
                                   id="num_factura" name="num_factura" value="{{ old('num_factura', $compra->num_factura) }}" required>
                            @error('num_factura')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="proveedor" class="form-label">Proveedor</label>
                            <select class="form-select @error('proveedor') is-invalid @enderror" 
                                    id="proveedor" name="proveedor" required>
                                @foreach($proveedores as $proveedor)
                                    <option value="{{ $proveedor->id }}" @if(old('proveedor', $compra->proveedor) == $proveedor->id) selected @endif>
                                        {{ $proveedor->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('proveedor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" 
                                   id="fecha" name="fecha" value="{{ old('fecha', $compra->fecha->format('Y-m-d')) }}" required>
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select @error('estado') is-invalid @enderror" 
                                    id="estado" name="estado" required>
                                <option value="PENDIENTE" @if(old('estado', $compra->estado) == 'PENDIENTE') selected @endif>PENDIENTE</option>
                                <option value="COMPLETADA" @if(old('estado', $compra->estado) == 'COMPLETADA') selected @endif>COMPLETADA</option>
                                <option value="CANCELADA" @if(old('estado', $compra->estado) == 'CANCELADA') selected @endif>CANCELADA</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="bi bi-save"></i> Actualizar Compra
                        </button>
                        <a href="{{ route('compras.index') }}" class="btn btn-secondary btn-custom">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
