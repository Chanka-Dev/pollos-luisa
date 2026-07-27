@extends('layouts.app')

@section('title', 'Detalles Producto')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Detalles del Producto</h1>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('inventarios.edit', $inventario->id) }}" class="btn btn-secondary">Editar</a>
            <a href="{{ route('inventarios.index') }}" class="btn btn-outline">Volver</a>
        </div>
    </div>

    <div style="display: grid; gap: 1rem; font-size: 1rem;">
        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">ID Producto</span>
            <div style="font-weight: 600;">#{{ $inventario->id }}</div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Nombre</span>
            <div style="font-weight: 600; font-size: 1.2rem; color: var(--primary-color);">{{ $inventario->producto }}</div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Stock Actual</span>
                <div style="font-weight: 600; font-size: 1.1rem;">{{ number_format($inventario->stock_actual, 2) }}</div>
            </div>

            <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Stock Mínimo</span>
                <div style="font-weight: 600; font-size: 1.1rem;">{{ number_format($inventario->stock_minimo, 2) }}</div>
            </div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Precio Unitario</span>
            <div style="font-weight: 600; font-size: 1.2rem; color: var(--accent-green);">Bs. {{ number_format($inventario->precio, 2) }}</div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Estado de Inventario</span>
            <div>
                @if($inventario->stock_actual <= $inventario->stock_minimo)
                    <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #f87171; padding: 0.4rem 0.8rem; font-size: 0.9rem;">⚠️ Alerta Stock Bajo</span>
                @else
                    <span class="badge" style="background: rgba(16, 185, 129, 0.2); color: #34d399; padding: 0.4rem 0.8rem; font-size: 0.9rem;">✓ Abastecimiento Normal</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
