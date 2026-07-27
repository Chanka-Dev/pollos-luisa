<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventarios';

    protected $fillable = [
        'producto',
        'stock_actual',
        'stock_minimo',
        'precio',
    ];

    /**
     * Relación con detalle_pedidos
     */
    public function detallePedidos()
    {
        return $this->hasMany(DetallePedido::class, 'inventario_id');
    }
}
