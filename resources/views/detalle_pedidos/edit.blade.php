@extends('layouts.app')

@section('title', 'Editar Detalle de Pedido')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Editar Detalle #{{ $detallePedido->id }}</h1>
        <a href="{{ route('detalle-pedidos.index') }}" class="btn btn-outline">Volver</a>
    </div>

    <form action="{{ route('detalle-pedidos.update', $detallePedido->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="pedido_id" class="form-label">Seleccionar Pedido</label>
            <select name="pedido_id" id="pedido_id" class="form-control" required>
                @foreach($pedidos as $p)
                    <option value="{{ $p->id }}" {{ (old('pedido_id', $detallePedido->pedido_id) == $p->id) ? 'selected' : '' }}>
                        Pedido #{{ $p->id }} - {{ $p->cliente ?? 'Consumidor Final' }}
                    </option>
                @endforeach
            </select>
            @error('pedido_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="inventario_id" class="form-label">Seleccionar Producto del Inventario</label>
            <select name="inventario_id" id="inventario_id" class="form-control" required>
                @foreach($inventarios as $inv)
                    <option value="{{ $inv->id }}" {{ (old('inventario_id', $detallePedido->inventario_id) == $inv->id) ? 'selected' : '' }}>
                        {{ $inv->producto }} (Bs. {{ number_format($inv->precio, 2) }})
                    </option>
                @endforeach
            </select>
            @error('inventario_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" step="0.01" name="cantidad" id="cantidad" class="form-control" value="{{ old('cantidad', $detallePedido->cantidad) }}" required>
            @error('cantidad')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="subtotal" class="form-label">Subtotal (Bs.)</label>
            <input type="number" step="0.01" name="subtotal" id="subtotal" class="form-control" value="{{ old('subtotal', $detallePedido->subtotal) }}">
            @error('subtotal')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('detalle-pedidos.index') }}" class="btn btn-outline">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar Detalle</button>
        </div>
    </form>
</div>
@endsection
