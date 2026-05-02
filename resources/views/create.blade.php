<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto</title>
    <style>
        /* Estilos básicos para que no se vea feo */
        form { max-width: 400px; margin: 20px auto; }
        div { margin-bottom: 15px; }
        label { display: block; font-weight: bold; }
        input, textarea { width: 100%; padding: 8px; }
        button { background: #28a745; color: white; padding: 10px 15px; border: none; cursor: pointer; }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <h1 style="text-align: center;">Nuevo Producto</h1>

    @if ($errors->any())
        <div class="alert-danger">
            <strong>¡Corrige los siguientes errores!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST"> 
        
        @csrf

        <div>
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" required>
        </div>

        <div>
            <label for="precio_compra">Precio de Compra:</label>
            <textarea name="precio_compra" id="precio_compra">{{ old('precio_compra') }}</textarea>
        </div>

        <div>
            <label for="precio_venta">Precio de Venta:</label>
            <input type="number" name="precio_venta" id="precio_venta" step="0.01" value="{{ old('precio_venta') }}" required>
        </div>
        <div>
            <label for="stock_actual">Stock Actual:</label>
            <input type="number" name="stock_actual" id="stock_actual" required>
        </div>
        <div>
            <label for="categoria">Categoria:</label>
            <select name="categoria" id="categoria">
                <option value="">Seleccione una categoria</option>
                    @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
            </select>
        </div>

        <div>
            <label for="proveedores">Proveedor:</label>
            <select name="proveedores" id="proveedores">
                <option value="">Selecciones un proveedor</option>
                    {{-- @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option> 
                    @endforeach --}}
            </select>
        </div>
        <button type="submit">Guardar Producto</button>
        <a href="{{ route('products.index') }}">Cancelar</a>
    </form>

</body>
</html>