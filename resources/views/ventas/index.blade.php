@extends('layouts.app')

@section('title', 'Ventas')

@section('content')
<div class="glass-card">
    <div class="card-header">
        <div>
            <h1 class="card-title">💰 Registro de Ventas</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Facturación y cierre de ventas realizadas</p>
        </div>
        <a href="{{ route('ventas.create') }}" class="btn btn-primary">
            + Registrar Venta
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Pedido ID</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total (Bs.)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ventas as $venta)
                <tr>
                    <td>#{{ $venta->id }}</td>
                    <td>
                        <a href="{{ route('pedidos.show', $venta->pedido_id) }}" style="color: var(--primary-color); text-decoration: underline;">
                            Pedido #{{ $venta->pedido_id }}
                        </a>
                    </td>
                    <td><strong>{{ $venta->pedido->cliente->nombre_completo ?? 'N/A' }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($venta->fecha)->format('d/m/Y H:i') }}</td>
                    <td><strong>Bs. {{ number_format($venta->total, 2) }}</strong></td>
                    <td>
                        <div class="actions-cell">
                            <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Ver</a>
                            <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Editar</a>
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" onsubmit="return confirm('¿Seguro de eliminar esta venta?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 2rem;">
                        No hay ventas registradas.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
