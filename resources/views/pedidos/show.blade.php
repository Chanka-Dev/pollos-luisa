@extends('layouts.app')

@section('title', 'Detalle de Pedido #' . $pedido->id)

@section('content')
<div class="glass-card">
    <div class="card-header">
        <div>
            <h1 class="card-title">Pedido #{{ $pedido->id }}</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">
                Cliente: <strong>{{ $pedido->cliente->nombre_completo ?? 'N/A' }}</strong> (CI: {{ $pedido->cliente->ci ?? 'N/A' }}) | 
                Fecha: {{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i') }}
            </p>
        </div>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('detalle-pedidos.create', ['pedido_id' => $pedido->id]) }}" class="btn btn-primary">
                + Agregar Ítem al Pedido
            </a>
            <a href="{{ route('pedidos.index') }}" class="btn btn-outline">Volver</a>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
        <div style="padding: 1rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Estado</span>
            <div style="margin-top: 0.25rem;">
                @if($pedido->estado == 'Completado')
                    <span class="badge" style="background: rgba(16, 185, 129, 0.2); color: #34d399;">✓ Completado</span>
                @elseif($pedido->estado == 'En preparación')
                    <span class="badge" style="background: rgba(245, 158, 11, 0.2); color: #fbbf24;">⏳ En Preparación</span>
                @elseif($pedido->estado == 'Cancelado')
                    <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #f87171;">✕ Cancelado</span>
                @else
                    <span class="badge" style="background: rgba(79, 70, 229, 0.2); color: #a5b4fc;">📌 Pendiente</span>
                @endif
            </div>
        </div>

        <div style="padding: 1rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Total Calculado</span>
            <div style="font-size: 1.3rem; font-weight: 700; color: var(--primary-color);">
                Bs. {{ number_format($pedido->total, 2) }}
            </div>
        </div>
    </div>

    <h2 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 1rem;">Ítems del Pedido</h2>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th># ID Detalle</th>
                    <th>Producto (Inventario)</th>
                    <th>Precio Unit. (Bs.)</th>
                    <th>Cantidad</th>
                    <th>Subtotal (Bs.)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedido->detalles as $det)
                <tr>
                    <td>#{{ $det->id }}</td>
                    <td><strong>{{ $det->inventario->producto ?? 'Producto borrado' }}</strong></td>
                    <td>Bs. {{ number_format($det->inventario->precio ?? 0, 2) }}</td>
                    <td>{{ number_format($det->cantidad, 2) }}</td>
                    <td><strong>Bs. {{ number_format($det->subtotal, 2) }}</strong></td>
                    <td>
                        <div class="actions-cell">
                            <a href="{{ route('detalle-pedidos.edit', $det->id) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Editar</a>
                            <form action="{{ route('detalle-pedidos.destroy', $det->id) }}" method="POST" onsubmit="return confirm('¿Seguro de quitar este ítem?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Quitar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem;">
                        Este pedido aún no tiene ítems agregados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
