<!DOCTYPE html>
<html>

<head>
    <title>Lista de productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
        text-align: left;
    }
    a {
        margin-right: 10px;
        text-decoration: none;
        color: blue;
      
    }
</style>

<body>
    <div class="container mt-5">
        <h1 style="text-align: center;">Lista de productos</h1>

        <a href="{{ route('products.create') }}" class="btn btn-primary mb-3" >Agregar Producto</a>
        <table>
            <thead>
                <tr>
                    
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th style="text-align: center;">Acciones</th> 
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                        <a href="{{ route('products.edit', $product->id) }}" >Editar</a>
                        </td>
                    </tr>
                   
                @endforeach
            </tbody>
        </table>
       
        
    </div>
</body>

</html>