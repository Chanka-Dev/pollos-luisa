@extends('layouts.app')

@section('title', 'Editar Producto - Inventario')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Editar Producto #{{ $inventario->id }}</h1>
        <a href="{{ route('inventarios.index') }}" class="btn btn-outline">Volver</a>
    </div>

    <form action="{{ route('inventarios.update', $inventario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="producto" class="form-label">Nombre del Producto</label>
            <input type="text" name="producto" id="producto" class="form-control" value="{{ old('producto', $inventario->producto) }}" required>
            @error('producto')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock_actual" class="form-label">Stock Actual</label>
            <input type="number" step="0.01" name="stock_actual" id="stock_actual" class="form-control" value="{{ old('stock_actual', $inventario->stock_actual) }}" required>
            @error('stock_actual')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="stock_minimo" class="form-label">Stock Mínimo (Alerta)</label>
            <input type="number" step="0.01" name="stock_minimo" id="stock_minimo" class="form-control" value="{{ old('stock_minimo', $inventario->stock_minimo) }}" required>
            @error('stock_minimo')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="precio" class="form-label">Precio Unitario (Bs.)</label>
            <input type="number" step="0.01" name="precio" id="precio" class="form-control" value="{{ old('precio', $inventario->precio) }}" required>
            @error('precio')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('inventarios.index') }}" class="btn btn-outline">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </div>
    </form>
</div>
@endsection
