<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Editar Producto</title>
        <style>
            /* Estilos básicos */
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
        <h1 style="text-align: center;">Editar Producto::{{$product->name}}</h1>

        @if ($errors->any())
        <div style="background-color: #f8d7da; padding: 10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <div>
                <label for="description">Descripción:</label>
                <textarea name="description" id="description">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label for="price">Precio:</label>
                <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $product->price) }}" required>
            </div>

            <div>
                <label for="stock">Stock:</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <button type="submit">Actualizar Producto</button>
            <a href="{{ route('products.index') }}">Cancelar</a>
        </form>
       

    </body>
</html>

