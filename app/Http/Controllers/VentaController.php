<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Pedido;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::with(['pedido.cliente', 'pedido.detalles.inventario'])->latest()->get();
        return view('ventas.index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pedidos = Pedido::with('cliente')->latest()->get();
        return view('ventas.create', compact('pedidos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);

        $venta = Venta::create($validated);

        return redirect()->route('ventas.index')->with('success', 'Venta registrada con éxito. ID: ' . $venta->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        $venta->load(['pedido.cliente', 'pedido.detalles.inventario']);
        return view('ventas.show', compact('venta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        $pedidos = Pedido::with('cliente')->latest()->get();
        return view('ventas.edit', compact('venta', 'pedidos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        $validated = $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'fecha' => 'required|date',
            'total' => 'required|numeric|min:0',
        ]);

        $venta->update($validated);

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta eliminada con éxito.');
    }
}
