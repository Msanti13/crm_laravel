<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Inventario - House Chicken')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            min-height: 100vh;
            padding: 20px 0;
        }
        .sidebar a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        .sidebar a:hover,
        .sidebar a.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            border-left-color: white;
            padding-left: 25px;
        }
        .content {
            padding: 30px;
        }
        .navbar-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
        .btn-custom {
            border-radius: 5px;
            font-weight: 500;
        }
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
        }
        .form-control, .form-select {
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        .alert {
            border-radius: 5px;
        }
        .badge-custom {
            padding: 6px 12px;
            border-radius: 20px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar">
                <h4 class="text-center mb-4">
                    <i class="bi bi-house-check"></i> House Chicken
                </h4>
                <nav>
                    <a href="{{ route('products.index') }}" class="@if(request()->routeIs('products.*')) active @endif">
                        <i class="bi bi-box"></i> Productos
                    </a>
                    <a href="{{ route('categorias.index') }}" class="@if(request()->routeIs('categorias.*')) active @endif">
                        <i class="bi bi-tags"></i> Categorías
                    </a>
                    <a href="{{ route('proveedores.index') }}" class="@if(request()->routeIs('proveedores.*')) active @endif">
                        <i class="bi bi-shop"></i> Proveedores
                    </a>
                    <a href="{{ route('clientes.index') }}" class="@if(request()->routeIs('clientes.*')) active @endif">
                        <i class="bi bi-people"></i> Clientes
                    </a>
                    <a href="{{ route('compras.index') }}" class="@if(request()->routeIs('compras.*')) active @endif">
                        <i class="bi bi-cart-plus"></i> Compras
                    </a>
                    <a href="{{ route('ventas.index') }}" class="@if(request()->routeIs('ventas.*')) active @endif">
                        <i class="bi bi-cart-check"></i> Ventas
                    </a>
                    <a href="{{ route('metodos_pago.index') }}" class="@if(request()->routeIs('metodos_pago.*')) active @endif">
                        <i class="bi bi-credit-card"></i> Métodos de Pago
                    </a>
                    <a href="{{ route('roles.index') }}" class="@if(request()->routeIs('roles.*')) active @endif">
                        <i class="bi bi-shield-check"></i> Roles
                    </a>
                </nav>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10">
                <nav class="navbar navbar-expand-lg navbar-custom mb-4">
                    <div class="container-fluid">
                        <span class="navbar-brand text-white">@yield('page_title', 'Dashboard')</span>
                        <div class="ms-auto">
                            @if(Auth::check())
                                <span class="text-white me-3">
                                    <i class="bi bi-person-circle"></i> {{ Auth::user()->nombre_usuario }}
                                </span>
                            @endif
                        </div>
                    </div>
                </nav>

                <div class="content">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <h4 class="alert-heading"><i class="bi bi-exclamation-circle"></i> Errores:</h4>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
