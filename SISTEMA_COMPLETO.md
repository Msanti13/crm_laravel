# Sistema de Inventario - House Chicken

## Descripción
Sistema completo de gestión de inventario, compras y ventas para House Chicken, desarrollado con Laravel, MySQL y Docker.

## Características Principales

### 🎯 Módulos Implementados

1. **Gestión de Productos**
   - CRUD completo de productos
   - Control de stock en tiempo real
   - Asociación con categorías y proveedores
   - Precios de compra y venta

2. **Gestión de Categorías**
   - Crear, editar y eliminar categorías
   - Clasificación de productos

3. **Gestión de Proveedores**
   - Registro de proveedores
   - Información de contacto (email, teléfono, dirección)
   - Historial de compras

4. **Gestión de Clientes**
   - Registro de clientes
   - Información personal (NIT, email, teléfono)
   - Historial de compras/ventas

5. **Gestión de Compras**
   - Registro de compras a proveedores
   - Detalles de productos comprados
   - Cálculo automático de totales
   - Actualización automática de stock
   - Estados de compra (PENDIENTE, COMPLETADA, CANCELADA)

6. **Gestión de Ventas**
   - Registro de ventas a clientes
   - Detalles de productos vendidos
   - Cálculo automático de totales
   - Descuento automático de stock
   - Estados de venta (PAGADA, PENDIENTE, CANCELADA)
   - Tipos de comprobante (FACTURA, BOLETA, NOTA_CREDITO)

7. **Métodos de Pago**
   - Crear y gestionar métodos de pago
   - Aplicar recargos automáticos

8. **Gestión de Roles**
   - Crear y asignar roles de usuario
   - Preparado para control de acceso

## Estructura del Proyecto

```
mi-proyecto/
├── app/
│   ├── Models/
│   │   ├── Product.php
│   │   ├── Categoria.php
│   │   ├── Proveedor.php
│   │   ├── Cliente.php
│   │   ├── Compra.php
│   │   ├── DetalleCompra.php
│   │   ├── Venta.php
│   │   ├── DetalleVenta.php
│   │   ├── MetodoPago.php
│   │   ├── Rol.php
│   │   ├── UsuarioRol.php
│   │   ├── MovInventario.php
│   │   └── User.php
│   ├── Http/
│   │   └── Controllers/
│   │       ├── ProductController.php
│   │       ├── CategoriaController.php
│   │       ├── ProveedorController.php
│   │       ├── ClienteController.php
│   │       ├── CompraController.php
│   │       ├── VentaController.php
│   │       ├── MetodoPagoController.php
│   │       └── RolController.php
│   └── Providers/
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php (Layout principal)
│       ├── productos/
│       ├── categorias/
│       ├── proveedores/
│       ├── clientes/
│       ├── compras/
│       ├── ventas/
│       ├── metodos_pago/
│       └── roles/
├── routes/
│   └── web.php (Todas las rutas definidas)
├── database/
│   └── database.sqlite (Base de datos SQLite)
└── compose.yaml (Configuración Docker)
```

## Instalación y Configuración

### Requisitos
- Docker y Docker Compose
- PHP 8.1 o superior
- MySQL 8.0 o superior
- Composer

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
cd /Users/melquisantiago/Documents/developer/mi-proyecto
```

2. **Instalar dependencias**
```bash
composer install
```

3. **Configurar variables de entorno**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Ejecutar migraciones**
```bash
php artisan migrate
```

5. **Iniciar los contenedores Docker**
```bash
docker-compose up -d
```

6. **Acceder a la aplicación**
```
http://localhost:8000
```

## Rutas Disponibles

### Productos
- `GET /products` - Listar productos
- `GET /products/crear` - Formulario crear
- `POST /products` - Guardar producto
- `GET /products/{id}/editar` - Formulario editar
- `PUT /products/{id}` - Actualizar producto
- `DELETE /products/{id}` - Eliminar producto

### Categorías
- `GET /categorias` - Listar
- `GET /categorias/create` - Crear
- `POST /categorias` - Guardar
- `GET /categorias/{id}/edit` - Editar
- `PUT /categorias/{id}` - Actualizar
- `DELETE /categorias/{id}` - Eliminar

### Proveedores
- `GET /proveedores` - Listar
- `GET /proveedores/create` - Crear
- `POST /proveedores` - Guardar
- `GET /proveedores/{id}/edit` - Editar
- `PUT /proveedores/{id}` - Actualizar
- `DELETE /proveedores/{id}` - Eliminar

### Clientes
- `GET /clientes` - Listar
- `GET /clientes/create` - Crear
- `POST /clientes` - Guardar
- `GET /clientes/{id}/edit` - Editar
- `PUT /clientes/{id}` - Actualizar
- `DELETE /clientes/{id}` - Eliminar

### Compras
- `GET /compras` - Listar
- `GET /compras/create` - Crear
- `POST /compras` - Guardar
- `GET /compras/{id}` - Ver detalles
- `GET /compras/{id}/edit` - Editar
- `PUT /compras/{id}` - Actualizar
- `DELETE /compras/{id}` - Eliminar

### Ventas
- `GET /ventas` - Listar
- `GET /ventas/create` - Crear
- `POST /ventas` - Guardar
- `GET /ventas/{id}` - Ver detalles
- `GET /ventas/{id}/edit` - Editar
- `PUT /ventas/{id}` - Actualizar
- `DELETE /ventas/{id}` - Eliminar

### Métodos de Pago
- `GET /metodos_pago` - Listar
- `GET /metodos_pago/create` - Crear
- `POST /metodos_pago` - Guardar
- `GET /metodos_pago/{id}/edit` - Editar
- `PUT /metodos_pago/{id}` - Actualizar
- `DELETE /metodos_pago/{id}` - Eliminar

### Roles
- `GET /roles` - Listar
- `GET /roles/create` - Crear
- `POST /roles` - Guardar
- `GET /roles/{id}/edit` - Editar
- `PUT /roles/{id}` - Actualizar
- `DELETE /roles/{id}` - Eliminar

## Funcionalidades Especiales

### Compras
- Al registrar una compra, el stock de los productos se actualiza automáticamente
- Cálculo automático del total de la compra
- Permite agregar múltiples productos en una sola compra
- Interfaz intuitiva para agregar/eliminar productos

### Ventas
- Al registrar una venta, el stock de los productos se descuenta automáticamente
- Cálculo automático del total de la venta
- Permite seleccionar múltiples productos
- Muestra el stock disponible de cada producto
- Soporte para diferentes tipos de comprobantes

### Validaciones
- Validación de datos en formularios
- Constraints de base de datos
- Prevención de valores negativos
- Validaciones de email único
- Validaciones de relaciones

## Diseño UI/UX

- **Interfaz moderna y responsiva** usando Bootstrap 5.3
- **Sidebar de navegación** con iconos de Bootstrap Icons
- **Gradiente de colores** profesional (púrpura)
- **Tablas interactivas** con efecto hover
- **Formularios intuitivos** con validación en tiempo real
- **Alertas visuales** para éxito y error
- **Badges** para estados y stock

## Base de Datos

La aplicación usa MySQL con las siguientes tablas:

- `productos` - Productos del inventario
- `categorias` - Categorías de productos
- `proveedores` - Proveedores
- `clientes` - Clientes
- `compras` - Registro de compras
- `detalle_compras` - Detalles de cada compra
- `ventas` - Registro de ventas
- `detalle_ventas` - Detalles de cada venta
- `metodos_pago` - Métodos de pago disponibles
- `usuarios` - Usuarios del sistema
- `roles` - Roles disponibles
- `usuarios_rol` - Asignación de roles a usuarios
- `mov_inventarios` - Movimientos de inventario (auditoría)

## Próximas Mejoras Sugeridas

1. **Autenticación y Autorización**
   - Implementar login/registro
   - Control de permisos por rol
   - Auditoría de acciones

2. **Reportes**
   - Reporte de ventas por período
   - Reporte de compras
   - Análisis de stock
   - Ganancias y pérdidas

3. **Dashboard**
   - Gráficos de ventas
   - Stock bajo alerta
   - Productos más vendidos
   - Resumen de ingresos

4. **API REST**
   - Endpoints para aplicaciones móviles
   - Autenticación token

5. **Mejoras de Rendimiento**
   - Paginación en listados
   - Búsqueda y filtros avanzados
   - Caché de consultas frecuentes

## Tecnologías Utilizadas

- **Backend**: Laravel 11
- **Frontend**: Blade Templates + Bootstrap 5.3
- **Base de Datos**: MySQL 8.0
- **Contenedorización**: Docker & Docker Compose
- **Iconos**: Bootstrap Icons
- **Validación**: Laravel Validation

## Contacto y Soporte

Para dudas o sugerencias sobre la implementación, contacta al equipo de desarrollo.

---

**Última actualización**: 30 de Abril de 2026
