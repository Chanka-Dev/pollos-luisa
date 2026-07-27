@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
<div class="glass-card">
    <div class="card-header">
        <div>
            <h1 class="card-title">📋 Gestión de Pedidos</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Registro y seguimiento de comandas de clientes</p>
        </div>
        <a href="{{ route('pedidos.create') }}" class="btn btn-primary">
            + Nuevo Pedido
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Total (Bs.)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedidos as $pedido)
                <tr>
                    <td>#{{ $pedido->id }}</td>
                    <td><strong>{{ $pedido->cliente->nombre_completo ?? 'N/A' }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($pedido->fecha)->format('d/m/Y H:i') }}</td>
                    <td>
                        @if($pedido->estado == 'Completado')
                            <span class="badge" style="background: rgba(16, 185, 129, 0.2); color: #34d399;">✓ Completado</span>
                        @elseif($pedido->estado == 'En preparación')
                            <span class="badge" style="background: rgba(245, 158, 11, 0.2); color: #fbbf24;">⏳ En Preparación</span>
                        @elseif($pedido->estado == 'Cancelado')
                            <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #f87171;">✕ Cancelado</span>
                        @else
                            <span class="badge" style="background: rgba(79, 70, 229, 0.2); color: #a5b4fc;">📌 Pendiente</span>
                        @endif
                    </td>
                    <td><strong>Bs. {{ number_format($pedido->total, 2) }}</strong></td>
                    <td>
                        <div class="actions-cell">
                            <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Ver Detalle</a>
                            <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Editar</a>
                            <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" onsubmit="return confirm('¿Seguro de eliminar este pedido?');" style="display:inline;">
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
                        No hay pedidos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
