<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Compra extends Model
{
    protected $table = 'compras';
    protected $fillable = ['fecha', 'num_factura', 'proveedor', 'id_factura', 'total', 'estado'];
    protected $casts = ['fecha' => 'date'];

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'proveedor', 'id');
    }

    public function detalleCompras(): HasMany
    {
        return $this->hasMany(DetalleCompra::class, 'id_compras', 'id');
    }
}
