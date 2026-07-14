<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $fillable = [
        'hora_entrada',
        'hora_salia',
        'dias_descanso',
    ];

    public function empleados()
    {
        return $this->hasMany(Empleado::class, 'id_turno');
    }
}
