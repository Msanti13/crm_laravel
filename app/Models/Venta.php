<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Venta extends Model
{
    protected $table = 'ventas';
    protected $fillable = ['usuario', 'cliente', 'fecha_emision', 'tipo_comprobante', 'metodo_pago', 'total', 'estado'];
    protected $casts = ['fecha_emision' => 'datetime'];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente', 'id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario', 'id');
    }

    public function metodoPago(): BelongsTo
    {
        return $this->belongsTo(MetodoPago::class, 'metodo_pago', 'id_met');
    }

    public function detalleVentas(): HasMany
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta', 'id');
    }
}
