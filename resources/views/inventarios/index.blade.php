@extends('layouts.app')

@section('title', 'Inventarios')

@section('content')
<div class="glass-card">
    <div class="card-header">
        <div>
            <h1 class="card-title">📦 Gestión de Inventario</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Control de insumos, productos y stock disponible</p>
        </div>
        <a href="{{ route('inventarios.create') }}" class="btn btn-primary">
            + Nuevo Producto
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Stock Actual</th>
                    <th>Stock Mínimo</th>
                    <th>Precio (Bs.)</th>
                    <th>Estado Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventarios as $inv)
                <tr>
                    <td>#{{ $inv->id }}</td>
                    <td><strong>{{ $inv->producto }}</strong></td>
                    <td>{{ number_format($inv->stock_actual, 2) }}</td>
                    <td>{{ number_format($inv->stock_minimo, 2) }}</td>
                    <td>Bs. {{ number_format($inv->precio, 2) }}</td>
                    <td>
                        @if($inv->stock_actual <= $inv->stock_minimo)
                            <span class="badge" style="background: rgba(239, 68, 68, 0.2); color: #f87171;">⚠️ Stock Bajo</span>
                        @else
                            <span class="badge" style="background: rgba(16, 185, 129, 0.2); color: #34d399;">✓ Normal</span>
                        @endif
                    </td>
                    <td>
                        <div class="actions-cell">
                            <a href="{{ route('inventarios.show', $inv->id) }}" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Ver</a>
                            <a href="{{ route('inventarios.edit', $inv->id) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Editar</a>
                            <form action="{{ route('inventarios.destroy', $inv->id) }}" method="POST" onsubmit="return confirm('¿Seguro de eliminar este producto del inventario?');" style="display:inline;">
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
                        No hay productos registrados en el inventario.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
