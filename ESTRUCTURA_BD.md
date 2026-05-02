# 📊 Estructura de Base de Datos - House Chicken

## Diagrama de Relaciones

```
┌─────────────────┐
│   categorias    │
├─────────────────┤
│ id (PK)         │
│ nombre          │
└────────┬────────┘
         │ 1:N
         │
    ┌────▼─────────────┐
    │   productos      │
    ├──────────────────┤
    │ id (PK)          │
    │ nombre           │
    │ precio_compra    │
    │ precio_venta     │
    │ stock_actual     │
    │ categoria (FK)   │◄──┐
    │ proveedor (FK)   │◄──┼──────────┐
    │ estado           │   │          │
    └────┬──────┬──────┘   │          │
         │      │          │          │
    1:N  │      │ 1:N   ┌──┴──────────┴────┐
         │      │       │   proveedores    │
         │      │       ├──────────────────┤
    ┌────▼──────▼───┐   │ id (PK)          │
    │  detalle_     │   │ nombre           │
    │  compras      │   │ email (UNIQUE)   │
    ├───────────────┤   │ telefono         │
    │ id (PK)       │   │ direccion        │
    │ id_compras(FK)├───►
    │ id_producto(FK)
    │ cantidad      │
    │ costo_u       │
    │ subtotal      │
    └──────┬────────┘
           │ 1:N
           │
    ┌──────▼─────────┐
    │    compras      │
    ├─────────────────┤
    │ id (PK)         │
    │ fecha           │
    │ num_factura     │
    │ proveedor (FK)  │◄─────────┐
    │ total           │          │
    │ estado          │      ┌───┴──────────┐
    └─────────────────┘      │              │
                             │              │

┌─────────────────┐
│   clientes      │
├─────────────────┤
│ id (PK)         │
│ nombre          │
│ nit             │
│ telefono        │
│ email (UNIQUE)  │
│ direccion       │
└────────┬────────┘
         │ 1:N
         │
    ┌────▼──────┐
    │   ventas   │
    ├────────────┤
    │ id (PK)    │
    │ usuario(FK)├────────┐
    │ cliente(FK)├────┐   │
    │ fecha_     │    │   │
    │  emision   │    │   │
    │ tipo_      │    │   │
    │  comprobante
    │ metodo_    │    │   │
    │  pago(FK)  ├───┐│   │
    │ total      │   ││   │
    │ estado     │   ││   │
    └────┬───────┘   ││   │
         │           ││   │
    1:N  │      ┌────▼▼───┴─────────┐
         │      │ detalle_ventas    │
    ┌────▼──────┤───────────────────┤
    │           │ id (PK)           │
    │      ┌────┤ id_venta (FK)     │
    │      │    │ id_producto (FK)  │
    │      │    │ cantidad          │
    │      │    │ precio_unitario   │
    │      │    │ subtotal          │
    │      │    └───────────────────┘
    │      │
    └──────┴─────────────────┐
                             │
                        ┌────▼──────────────┐
                        │ usuarios          │
                        ├───────────────────┤
                        │ id (PK)           │
                        │ nombres           │
                        │ email (UNIQUE)    │
                        │ nombre_usuario    │
                        │ password          │
                        │ activo            │
                        └────┬──────────────┘
                             │ M:N
                             │
                        ┌────▼──────────────┐
                        │ usuarios_rol      │
                        ├───────────────────┤
                        │ id (PK)           │
                        │ usuario (FK)      │
                        │ rol (FK)          │
                        └────────┬──────────┘
                                 │
                        ┌────────▼─────────┐
                        │ roles             │
                        ├──────────────────┤
                        │ id (PK)          │
                        │ nombres          │
                        └──────────────────┘

┌──────────────────┐
│ metodos_pago     │
├──────────────────┤
│ id_met (PK)      │
│ nombre           │
│ recargo          │
│ activo           │
└──────────────────┘

┌──────────────────────┐
│ mov_inventarios      │
├──────────────────────┤
│ id (PK)              │
│ producto_id (FK)     │
│ tipo_movimiento      │
│ cantidad             │
│ saldo_anterior       │
│ saldo_nuevo          │
│ fecha                │
│ referencia_id        │
└──────────────────────┘
```

## Tabla: categorias

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| nombre | VARCHAR(200) | No | UNIQUE | Nombre de la categoría |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

## Tabla: proveedores

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| nombre | VARCHAR(200) | No | | Nombre del proveedor |
| email | VARCHAR(200) | No | UNIQUE | Correo electrónico |
| telefono | VARCHAR(10) | No | | Número de teléfono |
| direccion | VARCHAR(200) | No | | Dirección |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

## Tabla: productos

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| nombre | VARCHAR(200) | No | | Nombre del producto |
| precio_compra | DECIMAL(10,2) | No | | Precio de compra |
| precio_venta | DECIMAL(10,2) | No | | Precio de venta |
| stock_actual | INT | No | | Stock disponible |
| categoria | INT | No | FK | Referencia a categorías |
| proveedor | INT | No | FK | Referencia a proveedores |
| estado | BOOLEAN | No | | Activo/Inactivo |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

**Relaciones:**
- `categoria` → categorias.id
- `proveedor` → proveedores.id

## Tabla: clientes

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| nombre | VARCHAR(200) | No | | Nombre del cliente |
| nit | INT | No | UNIQUE | NIT o Cédula |
| telefono | INT | No | | Teléfono |
| email | VARCHAR(100) | No | UNIQUE | Correo electrónico |
| direccion | VARCHAR(200) | No | | Dirección |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

## Tabla: compras

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| fecha | DATE | No | | Fecha de compra |
| num_factura | INT | No | UNIQUE | Número de factura |
| proveedor | INT | No | FK | Referencia a proveedores |
| total | DECIMAL(12,2) | No | | Total de compra |
| estado | VARCHAR(50) | No | | PENDIENTE / COMPLETADA / CANCELADA |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

**Relaciones:**
- `proveedor` → proveedores.id

## Tabla: detalle_compras

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| id_compras | INT | No | FK | Referencia a compras |
| id_producto | INT | No | FK | Referencia a productos |
| cantidad | INT | No | | Cantidad comprada |
| costo_u | DECIMAL(10,2) | No | | Costo unitario |
| subtotal | DECIMAL(12,2) | No | | Subtotal |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

**Relaciones:**
- `id_compras` → compras.id
- `id_producto` → productos.id

## Tabla: ventas

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| usuario | INT | No | FK | Referencia a usuarios |
| cliente | INT | No | FK | Referencia a clientes |
| fecha_emision | TIMESTAMP | No | | Fecha de emisión |
| tipo_comprobante | VARCHAR(20) | No | | FACTURA / BOLETA / NOTA_CREDITO |
| metodo_pago | INT | No | FK | Referencia a metodos_pago |
| total | DECIMAL(12,2) | No | | Total de venta |
| estado | VARCHAR(20) | No | | PAGADA / PENDIENTE / CANCELADA |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

**Relaciones:**
- `usuario` → usuarios.id
- `cliente` → clientes.id
- `metodo_pago` → metodos_pago.id_met

## Tabla: detalle_ventas

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| id_venta | INT | No | FK | Referencia a ventas |
| id_producto | INT | No | FK | Referencia a productos |
| cantidad | INT | No | | Cantidad vendida |
| precio_unitario | DECIMAL(10,2) | No | | Precio unitario |
| subtotal | DECIMAL(12,2) | No | | Subtotal |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

**Relaciones:**
- `id_venta` → ventas.id
- `id_producto` → productos.id

## Tabla: usuarios

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| nombres | VARCHAR(200) | No | | Nombre completo |
| email | VARCHAR(150) | No | UNIQUE | Correo electrónico |
| nombre_usuario | VARCHAR(50) | No | UNIQUE | Username |
| password | VARCHAR(255) | No | | Contraseña (hash) |
| activo | BOOLEAN | No | | Activo/Inactivo |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

## Tabla: roles

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| nombres | VARCHAR(200) | No | UNIQUE | Nombre del rol |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

## Tabla: usuarios_rol

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| usuario | INT | No | FK | Referencia a usuarios |
| rol | INT | No | FK | Referencia a roles |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

**Relaciones:**
- `usuario` → usuarios.id
- `rol` → roles.id

## Tabla: metodos_pago

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id_met | INT | No | PK | Identificador único |
| nombre | VARCHAR(50) | No | UNIQUE | Nombre del método |
| recargo | DECIMAL(5,2) | Sí | | Porcentaje de recargo |
| activo | BOOLEAN | No | | Activo/Inactivo |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

## Tabla: mov_inventarios

| Columna | Tipo | Null | Clave | Descripción |
|---------|------|------|-------|-------------|
| id | INT | No | PK | Identificador único |
| producto_id | INT | No | FK | Referencia a productos |
| tipo_movimiento | VARCHAR(20) | No | | COMPRA / VENTA / AJUSTE |
| cantidad | INT | No | | Cantidad movida |
| saldo_anterior | INT | No | | Stock anterior |
| saldo_nuevo | INT | No | | Stock nuevo |
| fecha | TIMESTAMP | No | | Fecha del movimiento |
| referencia_id | INT | Sí | | ID de compra/venta |
| created_at | TIMESTAMP | Sí | | Fecha de creación |
| updated_at | TIMESTAMP | Sí | | Fecha de actualización |

**Relaciones:**
- `producto_id` → productos.id

## Consultas Útiles

### Stock Total por Producto
```sql
SELECT p.nombre, p.stock_actual 
FROM productos p 
ORDER BY p.stock_actual ASC;
```

### Ventas por Período
```sql
SELECT DATE(v.fecha_emision) as fecha, SUM(v.total) as total_ventas
FROM ventas v
WHERE v.fecha_emision BETWEEN '2024-01-01' AND '2024-12-31'
GROUP BY DATE(v.fecha_emision)
ORDER BY fecha DESC;
```

### Compras por Proveedor
```sql
SELECT pr.nombre, COUNT(c.id) as total_compras, SUM(c.total) as monto
FROM compras c
JOIN proveedores pr ON c.proveedor = pr.id
GROUP BY c.proveedor
ORDER BY monto DESC;
```

### Productos Más Vendidos
```sql
SELECT p.nombre, SUM(dv.cantidad) as total_vendido, SUM(dv.subtotal) as ingresos
FROM detalle_ventas dv
JOIN productos p ON dv.id_producto = p.id
GROUP BY dv.id_producto
ORDER BY total_vendido DESC
LIMIT 10;
```

### Productos con Stock Bajo
```sql
SELECT nombre, stock_actual, precio_venta
FROM productos
WHERE stock_actual <= 10
ORDER BY stock_actual ASC;
```

---

**Nota**: Esta estructura es flexible y puede ser extendida con nuevas tablas o campos según necesidades futuras.
