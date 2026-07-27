<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Turno;
use App\Models\Empleado;
use App\Models\Cliente;
use App\Models\Inventario;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\Venta;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Turnos
        $t1 = Turno::create([
            'hora_entrada' => '08:00:00',
            'hora_salia' => '16:00:00',
            'dias_descanso' => 'Domingo',
        ]);

        $t2 = Turno::create([
            'hora_entrada' => '16:00:00',
            'hora_salia' => '23:59:00',
            'dias_descanso' => 'Lunes',
        ]);

        // 2. Empleados
        Empleado::create([
            'ci' => 1234567,
            'nombre_completo' => 'Lucía Méndez',
            'email' => 'lucia@pollosluisa.com',
            'rol' => 'Administradora',
            'id_turno' => $t1->id,
        ]);

        Empleado::create([
            'ci' => 7654321,
            'nombre_completo' => 'Carlos Mamani',
            'email' => 'carlos@pollosluisa.com',
            'rol' => 'Mesero',
            'id_turno' => $t2->id,
        ]);

        // 3. Clientes
        $c1 = Cliente::create([
            'ci' => 4567890,
            'nombre_completo' => 'Pedro López',
            'email' => 'pedro@gmail.com',
            'telefono' => 71234567,
            'fecha_nacimiento' => '1995-04-12',
        ]);

        $c2 = Cliente::create([
            'ci' => 9876543,
            'nombre_completo' => 'María Flores',
            'email' => 'maria@gmail.com',
            'telefono' => 78901234,
            'fecha_nacimiento' => '1998-09-25',
        ]);

        // 4. Inventarios
        $inv1 = Inventario::create([
            'producto' => 'Pollo Broaster (1/4 Pollo)',
            'stock_actual' => 50,
            'stock_minimo' => 10,
            'precio' => 25.00,
        ]);

        $inv2 = Inventario::create([
            'producto' => 'Papas Fritas (Porción Grande)',
            'stock_actual' => 30,
            'stock_minimo' => 5,
            'precio' => 12.00,
        ]);

        $inv3 = Inventario::create([
            'producto' => 'Gaseosa Coca-Cola 2 Litros',
            'stock_actual' => 20,
            'stock_minimo' => 4,
            'precio' => 15.00,
        ]);

        // 5. Pedidos
        $p1 = Pedido::create([
            'cliente_id' => $c1->id,
            'fecha' => now(),
            'estado' => 'Completado',
        ]);

        // 6. Detalle Pedidos
        DetallePedido::create([
            'pedido_id' => $p1->id,
            'inventario_id' => $inv1->id,
            'cantidad' => 2,
            'subtotal' => 50.00,
        ]);

        DetallePedido::create([
            'pedido_id' => $p1->id,
            'inventario_id' => $inv2->id,
            'cantidad' => 1,
            'subtotal' => 12.00,
        ]);

        // 7. Ventas
        Venta::create([
            'pedido_id' => $p1->id,
            'fecha' => now(),
            'total' => 62.00,
        ]);
    }
}
