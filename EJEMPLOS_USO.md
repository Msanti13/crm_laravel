# 📚 Ejemplos de Uso - Sistema House Chicken

## Acceso a la Aplicación

### URL Base
```
http://localhost:8000
```

### Navegación
- Usa el **sidebar izquierdo** para navegar entre módulos
- Cada módulo tiene opciones de crear, editar y eliminar

## Ejemplos de Uso por Módulo

### 1️⃣ GESTIÓN DE PRODUCTOS

#### Crear Producto
```
1. Clic en "Productos" en el sidebar
2. Clic en botón "Nuevo Producto"
3. Completar formulario:
   - Nombre: "Pollo Fresco 2kg"
   - Categoría: Seleccionar "Pollos"
   - Proveedor: Seleccionar "Granja XYZ"
   - Stock Inicial: "50"
   - Precio de Compra: "15000"
   - Precio de Venta: "25000"
   - Marcar "Producto Activo"
4. Clic en "Guardar Producto"
```

#### Editar Producto
```
1. En la tabla de productos
2. Clic en el botón "Editar" (lápiz amarillo)
3. Modificar los datos
4. Clic en "Actualizar Producto"
```

#### Eliminar Producto
```
1. En la tabla de productos
2. Clic en el botón "Eliminar" (rojo)
3. Confirmar en el diálogo
```

### 2️⃣ GESTIÓN DE COMPRAS

#### Registrar una Compra
```
1. Clic en "Compras" en el sidebar
2. Clic en "Nueva Compra"
3. Completar información general:
   - Número de Factura: "001"
   - Proveedor: Seleccionar proveedor
   - Fecha: Seleccionar fecha
   - Estado: "COMPLETADA"

4. En la sección "Detalles de la Compra":
   - Producto: Seleccionar un producto
   - Cantidad: 10
   - Costo Unitario: 15000
   
5. Clic en "Agregar Producto" para agregar más
6. El total se calcula automáticamente
7. Clic en "Registrar Compra"

⚡ IMPORTANTE: El stock se actualiza automáticamente
```

**Ejemplo**: Si compras 10 unidades de un producto con stock 50, después de la compra tendrá 60.

#### Ver Detalles de Compra
```
1. En la lista de compras
2. Clic en el botón "Ver" (ojo azul)
3. Se mostrará toda la información con detalles de productos
```

### 3️⃣ GESTIÓN DE VENTAS

#### Registrar una Venta
```
1. Clic en "Ventas" en el sidebar
2. Clic en "Nueva Venta"
3. Completar información:
   - Cliente: Seleccionar un cliente
   - Método de Pago: Seleccionar un método
   - Tipo de Comprobante: FACTURA / BOLETA / NOTA_CREDITO
   - Estado: PAGADA / PENDIENTE / CANCELADA

4. En "Productos de la Venta":
   - Producto: Seleccionar (verás el stock disponible)
   - Cantidad: Cantidad a vender
   - Precio Unitario: Precio de venta
   
5. Clic en "Agregar Producto" para más
6. El total se calcula automáticamente
7. Clic en "Registrar Venta"

⚡ IMPORTANTE: El stock se descuenta automáticamente
```

**Ejemplo**: Si vendes 5 unidades de un producto con stock 60, después de la venta tendrá 55.

#### Ver Detalles de Venta
```
1. En la lista de ventas
2. Clic en "Ver"
3. Se mostrará información completa del cliente, productos y total
```

### 4️⃣ GESTIÓN DE CLIENTES

#### Agregar Cliente
```
1. Clic en "Clientes"
2. Clic en "Nuevo Cliente"
3. Completar:
   - Nombre: "Juan Pérez"
   - NIT: "123456789"
   - Teléfono: "3001234567"
   - Email: "juan@example.com"
   - Dirección: "Calle Principal 123"
4. Clic en "Guardar Cliente"
```

### 5️⃣ GESTIÓN DE PROVEEDORES

#### Agregar Proveedor
```
1. Clic en "Proveedores"
2. Clic en "Nuevo Proveedor"
3. Completar:
   - Nombre: "Granja XYZ"
   - Email: "contacto@granja.com"
   - Teléfono: "3109876543"
   - Dirección: "Vereda El Bosque"
4. Clic en "Guardar Proveedor"
```

### 6️⃣ GESTIÓN DE CATEGORÍAS

#### Crear Categoría
```
1. Clic en "Categorías"
2. Clic en "Nueva Categoría"
3. Nombre: "Pollos Frescos"
4. Clic en "Guardar Categoría"
```

### 7️⃣ GESTIÓN DE MÉTODOS DE PAGO

#### Agregar Método de Pago
```
1. Clic en "Métodos de Pago"
2. Clic en "Nuevo Método"
3. Completar:
   - Nombre: "Transferencia Bancaria"
   - Recargo (%): "2.5" (Opcional)
   - Activo: Marcar (por defecto)
4. Clic en "Guardar Método"
```

### 8️⃣ GESTIÓN DE ROLES

#### Crear Rol
```
1. Clic en "Roles"
2. Clic en "Nuevo Rol"
3. Nombre: "Gerente de Ventas"
4. Clic en "Guardar Rol"
```

## 🔍 Búsqueda de Problemas Comunes

### Problema: No puedo crear una compra
**Solución**: 
1. Verifica que exista al menos 1 proveedor
2. Verifica que exista al menos 1 producto
3. Verifica que los datos obligatorios estén llenos

### Problema: El stock no se actualizó
**Solución**:
1. Verifica que la compra/venta se haya guardado correctamente
2. Comprueba el mensaje de éxito al final
3. Recarga la página

### Problema: No puedo eliminar un registro
**Solución**:
1. Puede que tenga dependencias en otras tablas
2. Intenta editar en lugar de eliminar
3. Verifica que existan registros que dependan de él

## 💡 Consejos de Uso

### Para Ventas Rápidas
```
1. Tener los clientes ya registrados
2. Tener los productos con precios actualizados
3. Usar el método de pago más común como predeterminado
```

### Para Compras Eficientes
```
1. Mantener la lista de proveedores actualizada
2. Registrar compras al mismo tiempo que recibes mercancía
3. Verificar los precios de compra antes de registrar
```

### Mantener Stock Actualizado
```
1. Registrar todas las compras inmediatamente
2. Registrar todas las ventas antes de entregar
3. Revisar periódicamente el stock
```

## 📊 Flujo General de Trabajo

```
┌─────────────────────────────────────────────────────┐
│     INICIO DE DÍA / SEMANA                           │
└──────────────────┬──────────────────────────────────┘
                   │
                   ▼
        ┌──────────────────────┐
        │  Revisar Stock       │
        │  (Productos)         │
        └──────────┬───────────┘
                   │
        ┌──────────▼───────────┐
        │ ¿Stock bajo?         │
        └─┬────────────────┬──┘
          │                │
       SÍ │                │ NO
          │                │
      ┌───▼────────┐   ┌──▼─────────┐
      │ COMPRA      │   │ CONTINUAR   │
      │ Productos   │   │             │
      └───┬─────────┘   └──┬──────────┘
          │                │
          └────┬───────────┘
               │
               ▼
      ┌────────────────────┐
      │  Recibir VENTAS    │
      │  de clientes       │
      └────────┬───────────┘
               │
               ▼
      ┌────────────────────┐
      │ Registrar VENTA    │
      │ en el sistema      │
      └────────┬───────────┘
               │
               ▼
      ┌────────────────────┐
      │ Stock se actualiza │
      │ automáticamente    │
      └────────┬───────────┘
               │
               ▼
      ┌────────────────────┐
      │  Fin de día        │
      │  Revisar reporte   │
      └────────────────────┘
```

## 🎓 Casos de Uso Reales

### Caso 1: Venta Diaria Típica
```
1. Abre la app a las 8 AM
2. Revisa stock en Productos (colores indican nivel)
3. Cliente llama para comprar 5 pollos
4. Vas a Ventas → Nueva Venta
5. Seleccionas cliente (o lo creas si es nuevo)
6. Agregas 5 pollos al precio de venta
7. Guarda la venta
8. Stock se descuenta automáticamente
9. El cliente recibe su comprobante
```

### Caso 2: Recepción de Compra de Proveedor
```
1. Recibes mercancía de tu proveedor
2. Contas y verificas cantidad
3. Vas a Compras → Nueva Compra
4. Registras los productos recibidos
5. Ingresas cantidad y costo unitario
6. Stock se incrementa automáticamente
7. Pagas la factura (registra en método de pago)
8. Listo para vender
```

### Caso 3: Transferencia a Otro Punto
```
1. Necesitas actualizar stock manualmente
2. Edita el producto
3. Cambia el stock a la cantidad correcta
4. Guarda los cambios
```

## 🔔 Alertas y Estados

### Estados de Compra
- 🟡 **PENDIENTE**: Compra registrada, pendiente de confirmar
- 🟢 **COMPLETADA**: Compra completada y procesada
- 🔴 **CANCELADA**: Compra cancelada

### Estados de Venta
- 🟢 **PAGADA**: Venta completada y pagada
- 🟡 **PENDIENTE**: Venta realizada, pendiente de pago
- 🔴 **CANCELADA**: Venta cancelada

### Niveles de Stock (Productos)
- 🟢 **Verde**: Stock > 10 unidades (Bien)
- 🟡 **Amarillo**: Stock entre 1-10 (Bajo)
- 🔴 **Rojo**: Stock = 0 (Agotado)

---

**¡Ahora estás listo para usar el sistema!** 🚀
