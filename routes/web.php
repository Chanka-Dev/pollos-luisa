<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TurnoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return redirect()->route('empleados.index');
});

Route::resource('turnos', TurnoController::class);
Route::resource('empleados', EmpleadoController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('inventarios', InventarioController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('detalle-pedidos', DetallePedidoController::class);
Route::resource('ventas', VentaController::class);
