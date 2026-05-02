@extends('layouts.app')

@section('title', 'Nueva Compra')
@section('page_title', 'Registrar Nueva Compra')

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Formulario de Compra</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('compras.store') }}" method="POST" id="formCompra">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="num_factura" class="form-label">Número de Factura</label>
                            <input type="number" class="form-control @error('num_factura') is-invalid @enderror" 
                                   id="num_factura" name="num_factura" value="{{ old('num_factura') }}" required>
                            @error('num_factura')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

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
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" 
                                   id="fecha" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" required>
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select @error('estado') is-invalid @enderror" 
                                    id="estado" name="estado" required>
                                <option value="PENDIENTE" @if(old('estado') == 'PENDIENTE') selected @endif>PENDIENTE</option>
                                <option value="COMPLETADA" @if(old('estado') == 'COMPLETADA') selected @endif>COMPLETADA</option>
                                <option value="CANCELADA" @if(old('estado') == 'CANCELADA') selected @endif>CANCELADA</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>
                    <h5>Detalles de la Compra</h5>

                    <div id="detalles-container">
                        <div class="detalle-item row mb-3">
                            <div class="col-md-5">
                                <label class="form-label">Producto</label>
                                <select class="form-select producto-select" name="productos[]">
                                    <option value="">Selecciona un producto</option>
                                    @foreach($productos as $producto)
                                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Cantidad</label>
                                <input type="number" class="form-control cantidad" name="cantidades[]" min="1" value="1">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Costo Unitario</label>
                                <input type="number" class="form-control costo" name="costos[]" step="0.01" min="0">
                            </div>
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" class="btn btn-danger w-100 btn-eliminar-detalle">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-secondary mb-3" id="btn-agregar-producto">
                        <i class="bi bi-plus-circle"></i> Agregar Producto
                    </button>

                    <div class="alert alert-info">
                        <strong>Total: $<span id="total-compra">0.00</span></strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="bi bi-save"></i> Registrar Compra
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const contenedor = document.getElementById('detalles-container');
    const btnAgregar = document.getElementById('btn-agregar-producto');
    const productos = {!! json_encode($productos) !!};

    function actualizarTotal() {
        let total = 0;
        document.querySelectorAll('.detalle-item').forEach(item => {
            const cantidad = parseFloat(item.querySelector('.cantidad').value) || 0;
            const costo = parseFloat(item.querySelector('.costo').value) || 0;
            total += cantidad * costo;
        });
        document.getElementById('total-compra').textContent = total.toFixed(2);
    }

    function agregarDetalle() {
        const html = `
            <div class="detalle-item row mb-3">
                <div class="col-md-5">
                    <select class="form-select producto-select" name="productos[]">
                        <option value="">Selecciona un producto</option>
                        ${productos.map(p => `<option value="${p.id}">${p.nombre}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control cantidad" name="cantidades[]" min="1" value="1">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control costo" name="costos[]" step="0.01" min="0">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger w-100 btn-eliminar-detalle">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </div>
            </div>
        `;
        contenedor.insertAdjacentHTML('beforeend', html);
        agregarEventos();
    }

    function agregarEventos() {
        document.querySelectorAll('.cantidad, .costo').forEach(input => {
            input.addEventListener('input', actualizarTotal);
        });

        document.querySelectorAll('.btn-eliminar-detalle').forEach(btn => {
            btn.addEventListener('click', function() {
                this.closest('.detalle-item').remove();
                actualizarTotal();
            });
        });
    }

    btnAgregar.addEventListener('click', agregarDetalle);
    agregarEventos();
    actualizarTotal();
});
</script>
@endsection
@endsection
