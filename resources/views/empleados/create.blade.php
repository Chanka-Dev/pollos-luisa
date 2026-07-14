@extends('layouts.app')

@section('title', 'Registrar Empleado')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Registrar Nuevo Empleado</h1>
        <a href="{{ route('empleados.index') }}" class="btn btn-outline">
            Volver
        </a>
    </div>

    @if($turnos->isEmpty())
        <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); padding: 1.5rem; border-radius: 8px; text-align: center;">
            <p style="color: #f87171; font-weight: 600; margin-bottom: 1rem;">No hay turnos disponibles.</p>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">
                Para poder registrar un empleado, primero debes crear al menos un turno en el sistema.
            </p>
            <a href="{{ route('turnos.create') }}" class="btn btn-primary">
                Crear un Turno Ahora
            </a>
        </div>
    @else
        <form action="{{ route('empleados.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="ci" class="form-label">Cédula de Identidad (CI)</label>
                <input type="number" name="ci" id="ci" class="form-control" placeholder="Ej: 8472938" value="{{ old('ci') }}" required>
                @error('ci')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="nombre_completo" class="form-label">Nombre Completo</label>
                <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" placeholder="Ej: Luisa Gómez" value="{{ old('nombre_completo') }}" required>
                @error('nombre_completo')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Ej: luisa@pollosluisa.com" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="rol" class="form-label">Rol / Cargo</label>
                <input type="text" name="rol" id="rol" class="form-control" placeholder="Ej: Cocinero, Cajero, Repartidor" value="{{ old('rol') }}" required>
                @error('rol')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="id_turno" class="form-label">Asignar Turno de Trabajo</label>
                <select name="id_turno" id="id_turno" class="form-control" required style="background: #111827;">
                    <option value="" disabled selected>-- Selecciona un Turno --</option>
                    @foreach($turnos as $turno)
                        <option value="{{ $turno->id }}" {{ old('id_turno') == $turno->id ? 'selected' : '' }}>
                            Entrada: {{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_entrada)->format('H:i') }} - Salida: {{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_salia)->format('H:i') }} (Descanso: {{ $turno->dias_descanso }})
                        </option>
                    @endforeach
                </select>
                @error('id_turno')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="flex: 1;">
                    Registrar Empleado
                </button>
                <a href="{{ route('empleados.index') }}" class="btn btn-outline" style="flex: 1; text-align: center;">
                    Cancelar
                </a>
            </div>
        </form>
    @endif
</div>
@endsection
