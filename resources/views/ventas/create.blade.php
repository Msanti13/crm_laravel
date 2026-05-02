@extends('layouts.app')

@section('title', 'Nueva Venta')
@section('page_title', 'Registrar Nueva Venta')

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Formulario de Venta</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('ventas.store') }}" method="POST" id="formVenta">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cliente" class="form-label">Cliente</label>
                            <select class="form-select @error('cliente') is-invalid @enderror" 
                                    id="cliente" name="cliente" required>
                                <option value="">Selecciona un cliente</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" @if(old('cliente') == $cliente->id) selected @endif>
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
                                <option value="">Selecciona método de pago</option>
                                @foreach($metodos_pago as $metodo)
                                    <option value="{{ $metodo->id_met }}" @if(old('metodo_pago') == $metodo->id_met) selected @endif>
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
                                <option value="FACTURA" @if(old('tipo_comprobante') == 'FACTURA') selected @endif>FACTURA</option>
                                <option value="BOLETA" @if(old('tipo_comprobante') == 'BOLETA') selected @endif>BOLETA</option>
                                <option value="NOTA_CREDITO" @if(old('tipo_comprobante') == 'NOTA_CREDITO') selected @endif>NOTA DE CRÉDITO</option>
                            </select>
                            @error('tipo_comprobante')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="estado" class="form-label">Estado</label>
                            <select class="form-select @error('estado') is-invalid @enderror" 
                                    id="estado" name="estado" required>
                                <option value="PAGADA" @if(old('estado') == 'PAGADA') selected @endif>PAGADA</option>
                                <option value="PENDIENTE" @if(old('estado') == 'PENDIENTE') selected @endif>PENDIENTE</option>
                                <option value="CANCELADA" @if(old('estado') == 'CANCELADA') selected @endif>CANCELADA</option>
                            </select>
                            @error('estado')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>
                    <h5>Productos de la Venta</h5>

                    <div id="detalles-container">
                        <div class="detalle-item row mb-3">
                            <div class="col-md-5">
                                <label class="form-label">Producto</label>
                                <select class="form-select producto-select" name="productos[]">
                                    <option value="">Selecciona un producto</option>
                                    @foreach($productos as $producto)
                                        <option value="{{ $producto->id }}" data-stock="{{ $producto->stock_actual }}">
                                            {{ $producto->nombre }} (Stock: {{ $producto->stock_actual }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Cantidad</label>
                                <input type="number" class="form-control cantidad" name="cantidades[]" min="1" value="1">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">Precio Unit.</label>
                                <input type="number" class="form-control precio" name="precios[]" step="0.01" min="0">
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
                        <strong>Total: $<span id="total-venta">0.00</span></strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary btn-custom">
                            <i class="bi bi-save"></i> Registrar Venta
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
            const precio = parseFloat(item.querySelector('.precio').value) || 0;
            total += cantidad * precio;
        });
        document.getElementById('total-venta').textContent = total.toFixed(2);
    }

    function agregarDetalle() {
        const html = `
            <div class="detalle-item row mb-3">
                <div class="col-md-5">
                    <select class="form-select producto-select" name="productos[]">
                        <option value="">Selecciona un producto</option>
                        ${productos.map(p => `<option value="${p.id}" data-stock="${p.stock_actual}">
                            ${p.nombre} (Stock: ${p.stock_actual})
                        </option>`).join('')}
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control cantidad" name="cantidades[]" min="1" value="1">
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control precio" name="precios[]" step="0.01" min="0">
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
        document.querySelectorAll('.cantidad, .precio').forEach(input => {
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
