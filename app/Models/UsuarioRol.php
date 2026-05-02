<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsuarioRol extends Model
{
    protected $table = 'usuarios_rol';
    protected $fillable = ['usuario', 'rol'];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario', 'id');
    }

    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'rol', 'id');
    }
}
