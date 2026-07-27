@extends('layouts.app')

@section('title', 'Editar Pedido')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Editar Pedido #{{ $pedido->id }}</h1>
        <a href="{{ route('pedidos.index') }}" class="btn btn-outline">Volver</a>
    </div>

    <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="cliente_id" class="form-label">Seleccionar Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required>
                @foreach($clientes as $cli)
                    <option value="{{ $cli->id }}" {{ old('cliente_id', $pedido->cliente_id) == $cli->id ? 'selected' : '' }}>
                        {{ $cli->nombre_completo }} (CI: {{ $cli->ci }})
                    </option>
                @endforeach
            </select>
            @error('cliente_id')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="fecha" class="form-label">Fecha y Hora</label>
            <input type="datetime-local" name="fecha" id="fecha" class="form-control" value="{{ old('fecha', \Carbon\Carbon::parse($pedido->fecha)->format('Y-m-d\TH:i')) }}" required>
            @error('fecha')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="estado" class="form-label">Estado del Pedido</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="Pendiente" {{ old('estado', $pedido->estado) == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="En preparación" {{ old('estado', $pedido->estado) == 'En preparación' ? 'selected' : '' }}>En preparación</option>
                <option value="Completado" {{ old('estado', $pedido->estado) == 'Completado' ? 'selected' : '' }}>Completado</option>
                <option value="Cancelado" {{ old('estado', $pedido->estado) == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
            </select>
            @error('estado')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('pedidos.index') }}" class="btn btn-outline">Cancelar</a>
            <button type="submit" class="btn btn-primary">Actualizar Pedido</button>
        </div>
    </form>
</div>
@endsection
