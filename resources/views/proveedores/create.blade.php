@extends('layouts.app')

@section('title', 'Crear Proveedor')
@section('page_title', 'Crear Nuevo Proveedor')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Formulario de Proveedor</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('proveedores.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                               id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="tel" class="form-control @error('telefono') is-invalid @enderror" 
                               id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <textarea class="form-control @error('direccion') is-invalid @enderror" 
                                  id="direccion" name="direccion" rows="3" required>{{ old('direccion') }}</textarea>
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="bi bi-save"></i> Guardar Proveedor
                        </button>
                        <a href="{{ route('proveedores.index') }}" class="btn btn-secondary btn-custom">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
