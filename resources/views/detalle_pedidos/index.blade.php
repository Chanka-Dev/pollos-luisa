@extends('layouts.app')

@section('title', 'Detalles de Pedidos')

@section('content')
<div class="glass-card">
    <div class="card-header">
        <div>
            <h1 class="card-title">🧾 Registro de Detalles de Pedidos</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Relación de productos consumidos por pedido e inventario</p>
        </div>
        <a href="{{ route('detalle-pedidos.create') }}" class="btn btn-primary">
            + Nuevo Detalle de Pedido
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pedido ID / Cliente</th>
                    <th>Producto (Inventario)</th>
                    <th>Cantidad</th>
                    <th>Subtotal (Bs.)</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($detalles as $det)
                <tr>
                    <td>#{{ $det->id }}</td>
                    <td>
                        <a href="{{ route('pedidos.show', $det->pedido_id) }}" style="color: var(--primary-color); text-decoration: underline;">
                            Pedido #{{ $det->pedido_id }} ({{ $det->pedido->cliente ?? 'Consumidor Final' }})
                        </a>
                    </td>
                    <td><strong>{{ $det->inventario->producto ?? 'N/A' }}</strong></td>
                    <td>{{ number_format($det->cantidad, 2) }}</td>
                    <td><strong>Bs. {{ number_format($det->subtotal, 2) }}</strong></td>
                    <td>{{ $det->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="actions-cell">
                            <a href="{{ route('detalle-pedidos.show', $det->id) }}" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Ver</a>
                            <a href="{{ route('detalle-pedidos.edit', $det->id) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Editar</a>
                            <form action="{{ route('detalle-pedidos.destroy', $det->id) }}" method="POST" onsubmit="return confirm('¿Seguro de eliminar este detalle?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 2rem;">
                        No hay detalles de pedidos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
