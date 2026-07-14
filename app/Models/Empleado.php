<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'ci',
        'nombre_completo',
        'email',
        'rol',
        'id_turno',
    ];

    public function turno()
    {
        return $this->belongsTo(Turno::class, 'id_turno');
    }
}
