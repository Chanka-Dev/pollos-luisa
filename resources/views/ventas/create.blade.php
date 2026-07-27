@extends('layouts.app')

@section('title', 'Nueva Venta')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Registrar Nueva Venta</h1>
        <a href="{{ route('ventas.index') }}" class="btn btn-outline">Volver</a>
    </div>

    <form action="{{ route('ventas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="pedido_id" class="form-label">Seleccionar Pedido</label>
            <select name="pedido_id" id="pedido_id" class="form-control" required onchange="updateTotal(this)">
                <option value="">-- Seleccione un Pedido --</option>
                @foreach($pedidos as $p)
                    <option value="{{ $p->id }}" data-total="{{ $p->total }}" {{ old('pedido_id') == $p->id ? 'selected' : '' }}>
                        Pedido #{{ $p->id }} - Cliente: {{ $p->cliente->nombre_completo ?? 'N/A' }} (Total: Bs. {{ number_format($p->total, 2) }})
                    </option>
                @endforeach
            </select>
            @error('pedido_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="fecha" class="form-label">Fecha y Hora de la Venta</label>
            <input type="datetime-local" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', now()->format('Y-m-d\TH:i')) }}" required>
            @error('fecha')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="total" class="form-label">Monto Total de Venta (Bs.)</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" value="{{ old('total') }}" required placeholder="Monto abonado/cobrado">
            @error('total')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('ventas.index') }}" class="btn btn-outline">Cancelar</a>
            <button type="submit" class="btn btn-primary">Registrar Venta</button>
        </div>
    </form>
</div>

<script>
function updateTotal(select) {
    var option = select.options[select.selectedIndex];
    var total = option.getAttribute('data-total');
    if (total) {
        document.getElementById('total').value = total;
    }
}
</script>
@endsection
