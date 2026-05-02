@extends('layouts.app')

@section('title', 'Editar Venta')
@section('page_title', 'Editar Venta #' . $venta->id)

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Editar Venta</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cliente" class="form-label">Cliente</label>
                            <select class="form-select @error('cliente') is-invalid @enderror" 
                                    id="cliente" name="cliente" required>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" @if(old('cliente', $venta->cliente_id) == $cliente->id) selected @endif>
                                        {{ $cliente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cliente')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="metodo_pago" class="form-label">Método de Pago</label>
                            <select class="form-select @error('metodo_pago') is-invalid @enderror" 
                                    id="metodo_pago" name="metodo_pago" required>
                                @foreach($metodos_pago as $metodo)
                                    <option value="{{ $metodo->id_met }}" @if(old('metodo_pago', $venta->metodo_pago) == $metodo->id_met) selected @endif>
                                        {{ $metodo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('metodo_pago')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="tipo_comprobante" class="form-label">Tipo de Comprobante</label>
                            <select class="form-select @error('tipo_comprobante') is-invalid @enderror" 
                                    id="tipo_comprobante" name="tipo_comprobante" required>
                                <option value="FACTURA" @if(old('tipo_comprobante', $venta->tipo_comprobante) == 'FACTURA') selected @endif>FACTURA</option>
                                <option value="BOLETA" @if(old('tipo_comprobante', $venta->tipo_comprobante) == 'BOLETA') selected @endif>BOLETA</option>
                                <option value="NOTA_CREDITO" @if(old('tipo_comprobante', $venta->tipo_comprobante) == 'NOTA_CREDITO') selected @endif>NOTA DE CRÉDITO</option>
                            </select>
                            @error('tipo_comprobante')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select @error('estado') is-invalid @enderror" 
                                    id="estado" name="estado" required>
                                <option value="PAGADA" @if(old('estado', $venta->estado) == 'PAGADA') selected @endif>PAGADA</option>
                                <option value="PENDIENTE" @if(old('estado', $venta->estado) == 'PENDIENTE') selected @endif>PENDIENTE</option>
                                <option value="CANCELADA" @if(old('estado', $venta->estado) == 'CANCELADA') selected @endif>CANCELADA</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="bi bi-save"></i> Actualizar Venta
                        </button>
                        <a href="{{ route('ventas.index') }}" class="btn btn-secondary btn-custom">
                            <i class="bi bi-arrow-left"></i> Volver
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
