@extends('layouts.app')

@section('title', 'Editar Venta')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Editar Venta #{{ $venta->id }}</h1>
        <a href="{{ route('ventas.index') }}" class="btn btn-outline">Volver</a>
    </div>

    <form action="{{ route('ventas.update', $venta->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="pedido_id" class="form-label">Seleccionar Pedido</label>
            <select name="pedido_id" id="pedido_id" class="form-control" required>
                @foreach($pedidos as $p)
                    <option value="{{ $p->id }}" {{ old('pedido_id', $venta->pedido_id) == $p->id ? 'selected' : '' }}>
                        Pedido #{{ $p->id }} - Cliente: {{ $p->cliente->nombre_completo ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
            @error('pedido_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="fecha" class="form-label">Fecha y Hora de la Venta</label>
            <input type="datetime-local" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', \Carbon\Carbon::parse($venta->fecha)->format('Y-m-d\TH:i')) }}" required>
            @error('fecha')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="total" class="form-label">Monto Total de Venta (Bs.)</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" value="{{ old('total', $venta->total) }}" required>
            @error('total')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('ventas.index') }}" class="btn btn-outline">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar Venta</button>
        </div>
    </form>
</div>
@endsection
