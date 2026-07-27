@extends('layouts.app')

@section('title', 'Nuevo Cliente')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Registrar Nuevo Cliente</h1>
        <a href="{{ route('clientes.index') }}" class="btn btn-outline">Volver</a>
    </div>

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="ci" class="form-label">Cédula de Identidad (CI)</label>
            <input type="number" name="ci" id="ci" class="form-control" value="{{ old('ci') }}" required placeholder="Ej. 12345678">
            @error('ci')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="nombre_completo" class="form-label">Nombre Completo</label>
            <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" value="{{ old('nombre_completo') }}" required placeholder="Ej. Juan Pérez">
            @error('nombre_completo')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required placeholder="Ej. juan@correo.com">
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="number" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}" required placeholder="Ej. 71234567">
            @error('telefono')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}" required>
            @error('fecha_nacimiento')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <a href="{{ route('clientes.index') }}" class="btn btn-outline">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar Cliente</button>
        </div>
    </form>
</div>
@endsection
