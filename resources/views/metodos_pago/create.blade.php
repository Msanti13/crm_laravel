@extends('layouts.app')

@section('title', 'Crear Método de Pago')
@section('page_title', 'Crear Nuevo Método de Pago')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Formulario de Método de Pago</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('metodos_pago.store') }}" method="POST">
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
                        <label for="recargo" class="form-label">Recargo (%)</label>
                        <input type="number" step="0.01" class="form-control @error('recargo') is-invalid @enderror" 
                               id="recargo" name="recargo" value="{{ old('recargo', 0) }}" min="0">
                        @error('recargo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="activo" name="activo" value="1" checked>
                        <label class="form-check-label" for="activo">Activo</label>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="bi bi-save"></i> Guardar Método
                        </button>
                        <a href="{{ route('metodos_pago.index') }}" class="btn btn-secondary btn-custom">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
