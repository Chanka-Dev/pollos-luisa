<?php

namespace App\Http\Controllers;

use App\Models\Turno;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turnos = Turno::withCount('empleados')->get();
        return view('turnos.index', compact('turnos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('turnos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salia' => 'required|date_format:H:i',
            'dias_descanso' => 'required|string|max:255',
        ]);

        Turno::create($validated);

        return redirect()->route('turnos.index')->with('success', 'Turno creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Turno $turno)
    {
        return redirect()->route('turnos.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Turno $turno)
    {
        return view('turnos.edit', compact('turno'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Turno $turno)
    {
        $validated = $request->validate([
            'hora_entrada' => 'required|date_format:H:i',
            'hora_salia' => 'required|date_format:H:i',
            'dias_descanso' => 'required|string|max:255',
        ]);

        $turno->update($validated);

        return redirect()->route('turnos.index')->with('success', 'Turno actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Turno $turno)
    {
        $turno->delete();

        return redirect()->route('turnos.index')->with('success', 'Turno eliminado con éxito.');
    }
}
