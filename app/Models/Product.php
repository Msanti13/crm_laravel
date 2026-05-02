<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'productos';
    protected $fillable=['nombre', 'precio_compra', 'precio_venta', 'stock_actual', 'categoria','proveedor','estado'];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria', 'id');
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor', 'id');
    }

    public function detalleCompras(): HasMany
    {
        return $this->hasMany(DetalleCompra::class, 'id_producto', 'id');
    }

    public function detalleVentas(): HasMany
    {
        return $this->hasMany(DetalleVenta::class, 'id_producto', 'id');
    }

    public function movInventarios(): HasMany
    {
        return $this->hasMany(MovInventario::class, 'producto_id', 'id');
    }
}
