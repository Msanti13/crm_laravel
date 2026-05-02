# 🎨 Guía de Personalización - Sistema House Chicken

## Cambiar Colores del Sistema

### Modificar Gradiente Principal
Archivo: `resources/views/layouts/app.blade.php`

```blade
<!-- Busca esta sección -->
<style>
    .sidebar {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    .navbar-custom {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
</style>

<!-- Cambia los colores hexadecimales a los que quieras -->
<!-- Por ejemplo, para azul y verde: -->
<!-- background: linear-gradient(135deg, #2196F3 0%, #4CAF50 100%); -->
```

### Colores Predefinidos:
```
Azul y Cian:       #0099FF 0%, #00D4FF 100%
Verde y Azul:      #4CAF50 0%, #2196F3 100%
Rojo y Naranja:    #FF6B6B 0%, #FF8E53 100%
Púrpura y Rosa:    #9D50BB 0%, #EF65B6 100%
Oscuro (Gray):     #34495e 0%, #2c3e50 100%
```

## Cambiar Nombre de la Aplicación

### En el Layout
Archivo: `resources/views/layouts/app.blade.php`

```blade
<!-- Busca esta línea -->
<h4 class="text-center mb-4">
    <i class="bi bi-house-check"></i> House Chicken
</h4>

<!-- Cambiala a tu nombre -->
<h4 class="text-center mb-4">
    <i class="bi bi-house-check"></i> Mi Negocio
</h4>
```

### En la Configuración de Laravel
Archivo: `config/app.php`

```php
'name' => env('APP_NAME', 'House Chicken'),

// Cambia a:
'name' => env('APP_NAME', 'Mi Negocio'),
```

## Cambiar Iconos

### Agregar Favicon
Archivo: `public/favicon.ico`

1. Prepara tu archivo PNG o ICO
2. Colócalo en `public/` como `favicon.ico`
3. Actualiza la referencia en `resources/views/layouts/app.blade.php`

### Cambiar Icono del Sidebar
Los iconos son de [Bootstrap Icons](https://icons.getbootstrap.com/)

```blade
<!-- Ejemplo actual -->
<i class="bi bi-house-check"></i> House Chicken

<!-- Otros iconos útiles -->
<i class="bi bi-shop"></i>           <!-- Tienda -->
<i class="bi bi-bag"></i>            <!-- Bolsa -->
<i class="bi bi-basket"></i>         <!-- Canasta -->
<i class="bi bi-cart"></i>           <!-- Carrito -->
<i class="bi bi-store"></i>          <!-- Almacén -->
<i class="bi bi-building"></i>       <!-- Edificio -->
```

## Personalizar el Dashboard (home.blade.php)

### Agregar Estadísticas
```blade
@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <h3 class="text-primary">{{ $totalProductos }}</h3>
                <p class="text-muted">Productos en Stock</p>
            </div>
        </div>
    </div>
</div>
@endsection
```

Luego en el controlador:
```php
public function index()
{
    $totalProductos = Product::count();
    $totalClientes = Cliente::count();
    $ventasHoy = Venta::whereDate('fecha_emision', today())->sum('total');
    
    return view('home', compact('totalProductos', 'totalClientes', 'ventasHoy'));
}
```

## Agregar Campos Adicionales

### Ejemplo: Agregar "Descripción" a Productos

1. **Crear Migración:**
```bash
docker exec mi-proyecto-app-1 php artisan make:migration add_description_to_products
```

2. **En el archivo de migración:**
```php
public function up()
{
    Schema::table('productos', function (Blueprint $table) {
        $table->text('descripcion')->nullable()->after('nombre');
    });
}
```

3. **Ejecutar migración:**
```bash
docker exec mi-proyecto-app-1 php artisan migrate
```

4. **Actualizar Modelo:**
```php
// app/Models/Product.php
protected $fillable = ['nombre', 'descripcion', 'precio_compra', ...];
```

5. **Actualizar Controlador:**
```php
// ProductController.php
$request->validate([
    'descripcion' => 'nullable|string|max:1000',
    // ... otras validaciones
]);
```

6. **Actualizar Vistas:**
```blade
<!-- En create.blade.php y edit.blade.php -->
<div class="mb-3">
    <label for="descripcion" class="form-label">Descripción</label>
    <textarea class="form-control" id="descripcion" name="descripcion">
        {{ old('descripcion', $product->descripcion ?? '') }}
    </textarea>
</div>
```

## Personalizar Validaciones

### Agregar Reglas Personalizadas
```php
// En ProductController@store
$request->validate([
    'nombre' => 'required|string|max:200|unique:productos',
    'precio_venta' => 'required|numeric|min:0|gt:precio_compra', // Mayor que
    'stock_actual' => 'required|integer|min:0|max:10000',
    'categoria' => 'required|exists:categorias,id',
], [
    'nombre.unique' => 'Este producto ya existe',
    'precio_venta.gt' => 'Precio de venta debe ser mayor al de compra',
]);
```

## Cambiar Tabla de Base de Datos

Si necesitas cambiar el nombre de una tabla:

1. **Crear nueva migración:**
```bash
docker exec mi-proyecto-app-1 php artisan make:migration rename_productos_table
```

2. **En la migración:**
```php
public function up()
{
    Schema::rename('productos', 'producto'); // Renombrar tabla
}

public function down()
{
    Schema::rename('producto', 'productos');
}
```

3. **Actualizar el Modelo:**
```php
protected $table = 'producto'; // Cambiar nombre
```

## Agregar Búsqueda en Listados

### Ejemplo en ProductController@index:
```php
public function index(Request $request)
{
    $query = Product::with('categoria', 'proveedor');
    
    if ($request->has('buscar')) {
        $buscar = $request->buscar;
        $query->where('nombre', 'LIKE', "%{$buscar}%")
              ->orWhereHas('categoria', function($q) use ($buscar) {
                  $q->where('nombre', 'LIKE', "%{$buscar}%");
              });
    }
    
    $products = $query->paginate(15);
    return view('productos.index', compact('products'));
}
```

### En la vista:
```blade
<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" class="form-control" name="buscar" 
               placeholder="Buscar producto..." value="{{ request('buscar') }}">
        <button class="btn btn-primary" type="submit">Buscar</button>
    </div>
</form>
```

## Agregar Paginación

En el controlador:
```php
public function index()
{
    $products = Product::paginate(15); // 15 por página
    return view('productos.index', compact('products'));
}
```

En la vista:
```blade
<!-- Tabla -->
<table class="table">
    <!-- ... contenido ... -->
</table>

<!-- Paginación -->
{{ $products->links() }}
```

## Personalizar Formato de Fechas

En los modelos:
```php
class Venta extends Model
{
    protected $casts = [
        'fecha_emision' => 'datetime:d/m/Y H:i',
        'created_at' => 'datetime:d/m/Y'
    ];
}
```

En las vistas:
```blade
{{ $venta->fecha_emision->format('d/m/Y H:i:s') }}
{{ $venta->created_at->diffForHumans() }} <!-- Hace 2 horas -->
```

## Agregar Permisos por Rol

### Crear Middleware:
```bash
docker exec mi-proyecto-app-1 php artisan make:middleware CheckRole
```

### En `app/Http/Middleware/CheckRole.php`:
```php
public function handle($request, Closure $next, $role)
{
    if (!auth()->check() || !auth()->user()->roles()->where('nombre', $role)->exists()) {
        return redirect('/')->with('error', 'No tienes permiso');
    }
    return $next($request);
}
```

### En rutas (`routes/web.php`):
```php
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::resource('productos', ProductController::class);
});
```

## Agregar Audit/Historial

En CompraController@store:
```php
// Después de crear la compra
MovInventario::create([
    'producto_id' => $producto->id,
    'tipo_movimiento' => 'COMPRA',
    'cantidad' => $cantidad,
    'saldo_anterior' => $stock_anterior,
    'saldo_nuevo' => $stock_nuevo,
    'referencia_id' => $compra->id
]);
```

## Personalizar Correos

Crear una notificación:
```bash
docker exec mi-proyecto-app-1 php artisan make:notification VentaRegistrada
```

En el controlador:
```php
// Después de guardar la venta
$cliente = $venta->cliente;
$cliente->notify(new VentaRegistrada($venta));
```

## Cambiar Tema de Bootstrap

Opción 1: Usar Bootswatch Themes
```blade
<!-- En layouts/app.blade.php, reemplaza el CDN de Bootstrap -->
<link href="https://bootswatch.com/5/darkly/bootstrap.min.css" rel="stylesheet">
```

Opciones: darkly, flatly, litera, solar, superhero, etc.

## Agregar Modal de Confirmación

```blade
<!-- En lugar de onclick confirm -->
<button type="button" class="btn btn-danger" data-bs-toggle="modal" 
        data-bs-target="#confirmDelete{{ $product->id }}">
    <i class="bi bi-trash"></i> Eliminar
</button>

<!-- Modal -->
<div class="modal fade" id="confirmDelete{{ $product->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar eliminación</h5>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este registro?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <form method="POST" action="{{ route('products.destroy', $product->id) }}" 
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
```

## Cambiar Idioma a Español

En `config/app.php`:
```php
'locale' => 'es',
```

Crear archivo `resources/lang/es/validation.php` con mensajes en español.

## Agregar Exportar a Excel

Instalar librería:
```bash
docker exec mi-proyecto-app-1 composer require maatwebsite/excel
```

En el controlador:
```php
use Maatwebsite\Excel\Facades\Excel;

public function export()
{
    return Excel::download(new ProductosExport, 'productos.xlsx');
}
```

---

## 💡 Recursos Útiles

- [Bootstrap Icons](https://icons.getbootstrap.com/)
- [Bootstrap Documentation](https://getbootstrap.com/docs/)
- [Laravel Docs](https://laravel.com/docs/)
- [Eloquent Relationships](https://laravel.com/docs/eloquent-relationships)
- [Blade Templates](https://laravel.com/docs/blade)

---

¡Estos son solo algunos ejemplos! El sistema es completamente flexible y personalizable.
