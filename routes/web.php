<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TurnoController;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return redirect()->route('empleados.index');
});

Route::resource('turnos', TurnoController::class);
Route::resource('empleados', EmpleadoController::class);
