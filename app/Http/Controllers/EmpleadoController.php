<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Turno;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::with('turno')->get();
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $turnos = Turno::all();
        return view('empleados.create', compact('turnos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ci' => 'required|integer|unique:empleados,ci',
            'nombre_completo' => 'required|string|max:255',
            'email' => 'required|email|unique:empleados,email|max:255',
            'rol' => 'required|string|max:255',
            'id_turno' => 'required|exists:turnos,id',
        ]);

        Empleado::create($validated);

        return redirect()->route('empleados.index')->with('success', 'Empleado registrado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        $empleado->load('turno');
        return view('empleados.show', compact('empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empleado $empleado)
    {
        $turnos = Turno::all();
        return view('empleados.edit', compact('empleado', 'turnos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empleado $empleado)
    {
        $validated = $request->validate([
            'ci' => 'required|integer|unique:empleados,ci,' . $empleado->id,
            'nombre_completo' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:empleados,email,' . $empleado->id,
            'rol' => 'required|string|max:255',
            'id_turno' => 'required|exists:turnos,id',
        ]);

        $empleado->update($validated);

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado con éxito.');
    }
}
