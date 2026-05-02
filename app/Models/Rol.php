<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rol extends Model
{
    protected $table = 'roles';
    protected $fillable = ['nombres'];

    public function usuarios(): HasMany
    {
        return $this->hasMany(UsuarioRol::class, 'rol', 'id');
    }
}
