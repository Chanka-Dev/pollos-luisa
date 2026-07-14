@extends('layouts.app')

@section('title', 'Editar Turno')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Editar Turno #{{ $turno->id }}</h1>
        <a href="{{ route('turnos.index') }}" class="btn btn-outline">
            Volver
        </a>
    </div>

    <form action="{{ route('turnos.update', $turno->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="hora_entrada" class="form-label">Hora de Entrada (HH:MM)</label>
            <!-- Format from HH:MM:SS to HH:MM if needed -->
            <input type="time" name="hora_entrada" id="hora_entrada" class="form-control" 
                   value="{{ old('hora_entrada', \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_entrada)->format('H:i')) }}" required>
            @error('hora_entrada')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="hora_salia" class="form-label">Hora de Salida (HH:MM)</label>
            <input type="time" name="hora_salia" id="hora_salia" class="form-control" 
                   value="{{ old('hora_salia', \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_salia)->format('H:i')) }}" required>
            @error('hora_salia')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="dias_descanso" class="form-label">Días de Descanso</label>
            <input type="text" name="dias_descanso" id="dias_descanso" class="form-control" 
                   value="{{ old('dias_descanso', $turno->dias_descanso) }}" required>
            @error('dias_descanso')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; gap: 1rem; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">
                Actualizar Turno
            </button>
            <a href="{{ route('turnos.index') }}" class="btn btn-outline" style="flex: 1; text-align: center;">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
