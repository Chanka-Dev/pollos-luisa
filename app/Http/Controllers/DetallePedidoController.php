<?php

namespace App\Http\Controllers;

use App\Models\DetallePedido;
use App\Models\Pedido;
use App\Models\Inventario;
use Illuminate\Http\Request;

class DetallePedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalles = DetallePedido::with(['pedido.cliente', 'inventario'])->latest()->get();
        return view('detalle_pedidos.index', compact('detalles'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $pedidos = Pedido::with('cliente')->latest()->get();
        $inventarios = Inventario::where('stock_actual', '>', 0)->get();
        $selected_pedido_id = $request->query('pedido_id');

        return view('detalle_pedidos.create', compact('pedidos', 'inventarios', 'selected_pedido_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'inventario_id' => 'required|exists:inventarios,id',
            'cantidad' => 'required|numeric|min:0.01',
            'subtotal' => 'nullable|numeric|min:0',
        ]);

        $inventario = Inventario::findOrFail($validated['inventario_id']);

        if (!isset($validated['subtotal']) || $validated['subtotal'] == 0) {
            $validated['subtotal'] = $validated['cantidad'] * $inventario->precio;
        }

        $detalle = DetallePedido::create($validated);

        // Descontar stock de inventario
        $inventario->decrement('stock_actual', $validated['cantidad']);

        return redirect()->route('pedidos.show', $validated['pedido_id'])
            ->with('success', 'Detalle de pedido agregado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetallePedido $detallePedido)
    {
        $detallePedido->load(['pedido.cliente', 'inventario']);
        return view('detalle_pedidos.show', compact('detallePedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetallePedido $detallePedido)
    {
        $pedidos = Pedido::with('cliente')->get();
        $inventarios = Inventario::all();
        return view('detalle_pedidos.edit', compact('detallePedido', 'pedidos', 'inventarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetallePedido $detallePedido)
    {
        $validated = $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'inventario_id' => 'required|exists:inventarios,id',
            'cantidad' => 'required|numeric|min:0.01',
            'subtotal' => 'nullable|numeric|min:0',
        ]);

        $inventario = Inventario::findOrFail($validated['inventario_id']);

        if (!isset($validated['subtotal']) || $validated['subtotal'] == 0) {
            $validated['subtotal'] = $validated['cantidad'] * $inventario->precio;
        }

        $detallePedido->update($validated);

        return redirect()->route('pedidos.show', $validated['pedido_id'])
            ->with('success', 'Detalle de pedido actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetallePedido $detallePedido)
    {
        $pedidoId = $detallePedido->pedido_id;
        $detallePedido->delete();

        return redirect()->route('pedidos.show', $pedidoId)
            ->with('success', 'Detalle de pedido eliminado con éxito.');
    }
}
