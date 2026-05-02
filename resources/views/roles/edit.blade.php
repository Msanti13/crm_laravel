@extends('layouts.app')

@section('title', 'Editar Rol')
@section('page_title', 'Editar Rol')

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Editar Rol - {{ $rol->nombres }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('roles.update', $rol->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="nombres" class="form-label">Nombre del Rol</label>
                        <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                               id="nombres" name="nombres" value="{{ old('nombres', $rol->nombres) }}" required>
                        @error('nombres')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="bi bi-save"></i> Actualizar Rol
                        </button>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-custom">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
