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
            <label for="name">Nombre del Producto:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
        </div>

        <div>
            <label for="description">Descripción:</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="price">Precio:</label>
            <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}" required>
        </div>
        <div>
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock" required>
        </div>
        <button type="submit">Guardar Producto</button>
        <a href="{{ route('products.index') }}">Cancelar</a>
    </form>

</body>
</html>