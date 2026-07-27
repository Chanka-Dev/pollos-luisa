@extends('layouts.app')

@section('title', 'Detalles de Venta #' . $venta->id)

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Detalles de Venta #{{ $venta->id }}</h1>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-secondary">Editar</a>
            <a href="{{ route('ventas.index') }}" class="btn btn-outline">Volver</a>
        </div>
    </div>

    <div style="display: grid; gap: 1rem; font-size: 1rem;">
        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Pedido Asociado</span>
            <div>
                <a href="{{ route('pedidos.show', $venta->pedido_id) }}" style="color: var(--primary-color); font-weight: 600; text-decoration: underline;">
                    Pedido #{{ $venta->pedido_id }} (Cliente: {{ $venta->pedido->cliente->nombre_completo ?? 'N/A' }})
                </a>
            </div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Fecha y Hora</span>
            <div style="font-weight: 600; font-size: 1.1rem;">{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') }}</div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Monto Total Cobrado</span>
            <div style="font-weight: 700; font-size: 1.4rem; color: var(--accent-green);">
                Bs. {{ number_format($venta->total, 2) }}
            </div>
        </div>
    </div>
</div>
@endsection
