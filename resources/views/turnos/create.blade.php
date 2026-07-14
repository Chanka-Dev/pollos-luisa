@extends('layouts.app')

@section('title', 'Nuevo Turno')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Registrar Nuevo Turno</h1>
        <a href="{{ route('turnos.index') }}" class="btn btn-outline">
            Volver
        </a>
    </div>

    <form action="{{ route('turnos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="hora_entrada" class="form-label">Hora de Entrada (HH:MM)</label>
            <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" value="{{ old('hora_entrada') }}" required>
            @error('hora_entrada')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="hora_salia" class="form-label">Hora de Salida (HH:MM)</label>
            <input type="time" name="hora_salia" id="hora_salia" class="form-control" value="{{ old('hora_salia') }}" required>
            @error('hora_salia')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="dias_descanso" class="form-label">Días de Descanso (Ej: Sábado y Domingo)</label>
            <input type="text" name="dias_descanso" id="dias_descanso" class="form-control" placeholder="Ej. Sábado y Domingo" value="{{ old('dias_descanso') }}" required>
            @error('dias_descanso')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">
                Guardar Turno
            </button>
            <a href="{{ route('turnos.index') }}" class="btn btn-outline" style="flex: 1; text-align: center;">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
