<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovInventario extends Model
{
    protected $table = 'mov_inventarios';
    protected $fillable = ['producto_id', 'tipo_movimiento', 'cantidad', 'saldo_anterior', 'saldo_nuevo', 'fecha', 'referencia_id'];
    protected $casts = ['fecha' => 'datetime'];

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'producto_id', 'id');
    }
}
