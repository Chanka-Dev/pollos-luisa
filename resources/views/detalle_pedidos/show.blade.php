@extends('layouts.app')

@section('title', 'Detalle de Pedido #' . $detallePedido->id)

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Información del Detalle #{{ $detallePedido->id }}</h1>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('detalle-pedidos.edit', $detallePedido->id) }}" class="btn btn-secondary">Editar</a>
            <a href="{{ route('detalle-pedidos.index') }}" class="btn btn-outline">Volver</a>
        </div>
    </div>

    <div style="display: grid; gap: 1rem; font-size: 1rem;">
        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Pedido Asociado</span>
            <div>
                <a href="{{ route('pedidos.show', $detallePedido->pedido_id) }}" style="color: var(--primary-color); font-weight: 600; text-decoration: underline;">
                    Pedido #{{ $detallePedido->pedido_id }} ({{ $detallePedido->pedido->cliente ?? 'Consumidor Final' }})
                </a>
            </div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Producto de Inventario</span>
            <div style="font-weight: 600; font-size: 1.1rem; color: var(--text-main);">
                {{ $detallePedido->inventario->producto ?? 'N/A' }}
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Cantidad</span>
                <div style="font-weight: 600; font-size: 1.1rem;">{{ number_format($detallePedido->cantidad, 2) }}</div>
            </div>

            <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Precio Unitario</span>
                <div style="font-weight: 600; font-size: 1.1rem;">Bs. {{ number_format($detallePedido->inventario->precio ?? 0, 2) }}</div>
            </div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Subtotal Calculado</span>
            <div style="font-weight: 700; font-size: 1.3rem; color: var(--accent-green);">
                Bs. {{ number_format($detallePedido->subtotal, 2) }}
            </div>
        </div>
    </div>
</div>
@endsection
