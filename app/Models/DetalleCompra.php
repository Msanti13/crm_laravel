<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetalleCompra extends Model
{
    protected $table = 'detalle_compras';
    protected $fillable = ['id_compras', 'id_producto', 'cantidad', 'costo_u', 'subtotal'];

    public function compra(): BelongsTo
    {
        return $this->belongsTo(Compra::class, 'id_compras', 'id');
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'id_producto', 'id');
    }
}
