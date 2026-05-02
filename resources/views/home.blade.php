@extends('layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Panel de Control')

@section('content')
<div class="row">
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-box" style="font-size: 2rem; color: #667eea;"></i>
                <h5 class="card-title mt-3">Productos</h5>
                <p class="card-text">Gestiona tu inventario</p>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-primary">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-cart-plus" style="font-size: 2rem; color: #764ba2;"></i>
                <h5 class="card-title mt-3">Compras</h5>
                <p class="card-text">Registro de compras</p>
                <a href="{{ route('compras.index') }}" class="btn btn-sm btn-primary">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-cart-check" style="font-size: 2rem; color: #667eea;"></i>
                <h5 class="card-title mt-3">Ventas</h5>
                <p class="card-text">Registro de ventas</p>
                <a href="{{ route('ventas.index') }}" class="btn btn-sm btn-primary">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-people" style="font-size: 2rem; color: #764ba2;"></i>
                <h5 class="card-title mt-3">Clientes</h5>
                <p class="card-text">Gestión de clientes</p>
                <a href="{{ route('clientes.index') }}" class="btn btn-sm btn-primary">Ver</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-shop" style="font-size: 2rem; color: #667eea;"></i>
                <h5 class="card-title mt-3">Proveedores</h5>
                <p class="card-text">Gestión de proveedores</p>
                <a href="{{ route('proveedores.index') }}" class="btn btn-sm btn-primary">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-tags" style="font-size: 2rem; color: #764ba2;"></i>
                <h5 class="card-title mt-3">Categorías</h5>
                <p class="card-text">Gestión de categorías</p>
                <a href="{{ route('categorias.index') }}" class="btn btn-sm btn-primary">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-credit-card" style="font-size: 2rem; color: #667eea;"></i>
                <h5 class="card-title mt-3">Métodos de Pago</h5>
                <p class="card-text">Gestión de pagos</p>
                <a href="{{ route('metodos_pago.index') }}" class="btn btn-sm btn-primary">Ver</a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card h-100">
            <div class="card-body text-center">
                <i class="bi bi-shield-check" style="font-size: 2rem; color: #764ba2;"></i>
                <h5 class="card-title mt-3">Roles</h5>
                <p class="card-text">Gestión de roles</p>
                <a href="{{ route('roles.index') }}" class="btn btn-sm btn-primary">Ver</a>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Bienvenido a House Chicken</h5>
            </div>
            <div class="card-body">
                <p>
                    Este es un sistema completo de gestión de inventario, compras y ventas. 
                    Utiliza el menú lateral para navegar por los diferentes módulos.
                </p>
                <p class="mb-0">
                    <strong>Características principales:</strong>
                </p>
                <ul>
                    <li>Gestión completa de productos y categorías</li>
                    <li>Registro de compras con actualización automática de stock</li>
                    <li>Registro de ventas con descuento automático de stock</li>
                    <li>Gestión de clientes y proveedores</li>
                    <li>Múltiples métodos de pago</li>
                    <li>Control de roles y permisos</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
