@extends('layouts.app')

@section('title', 'Nuevo Detalle de Pedido')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Agregar Detalle a Pedido</h1>
        <a href="{{ route('detalle-pedidos.index') }}" class="btn btn-outline">Volver</a>
    </div>

    <form action="{{ route('detalle-pedidos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="pedido_id" class="form-label">Seleccionar Pedido</label>
            <select name="pedido_id" id="pedido_id" class="form-control" required>
                <option value="">-- Seleccione un Pedido --</option>
                @foreach($pedidos as $p)
                    <option value="{{ $p->id }}" {{ (old('pedido_id', $selected_pedido_id) == $p->id) ? 'selected' : '' }}>
                        Pedido #{{ $p->id }} - {{ $p->cliente ?? 'Consumidor Final' }} (Mesa: {{ $p->mesa ?? 'N/A' }})
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
                <option value="">-- Seleccione un Producto --</option>
                @foreach($inventarios as $inv)
                    <option value="{{ $inv->id }}" {{ old('inventario_id') == $inv->id ? 'selected' : '' }}>
                        {{ $inv->producto }} (Stock: {{ number_format($inv->stock_actual, 2) }} | Precio: Bs. {{ number_format($inv->precio, 2) }})
                    </option>
                @endforeach
            </select>
            @error('inventario_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" step="0.01" name="cantidad" id="cantidad" class="form-control" value="{{ old('cantidad', 1) }}" required>
            @error('cantidad')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="subtotal" class="form-label">Subtotal (Bs.) - Dejar en 0 o vacío para auto-calcular</label>
            <input type="number" step="0.01" name="subtotal" id="subtotal" class="form-control" value="{{ old('subtotal') }}" placeholder="Auto-calculado si se deja vacío">
            @error('subtotal')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('detalle-pedidos.index') }}" class="btn btn-outline">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar Detalle</button>
        </div>
    </form>
</div>
@endsection
