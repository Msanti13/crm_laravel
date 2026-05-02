<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleVenta extends Model
{
    protected $table = 'detalle_ventas';
    protected $fillable = ['id_venta', 'id_producto', 'cantidad', 'precio_unitario', 'subtotal'];

    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class, 'id_venta', 'id');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_producto', 'id');
    }
}
