@extends('layouts.app')

@section('title', 'Editar Empleado')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Editar Empleado #{{ $empleado->id }}</h1>
        <a href="{{ route('empleados.index') }}" class="btn btn-outline">
            Volver
        </a>
    </div>

    <form action="{{ route('empleados.update', $empleado->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="ci" class="form-label">Cédula de Identidad (CI)</label>
            <input type="number" name="ci" id="ci" class="form-control" value="{{ old('ci', $empleado->ci) }}" required>
            @error('ci')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="nombre_completo" class="form-label">Nombre Completo</label>
            <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" value="{{ old('nombre_completo', $empleado->nombre_completo) }}" required>
            @error('nombre_completo')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $empleado->email) }}" required>
            @error('email')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="rol" class="form-label">Rol / Cargo</label>
            <input type="text" name="rol" id="rol" class="form-control" value="{{ old('rol', $empleado->rol) }}" required>
            @error('rol')
                <span class="error-message">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="id_turno" class="form-label">Asignar Turno de Trabajo</label>
            <select name="id_turno" id="id_turno" class="form-control" required style="background: #111827;">
                @foreach($turnos as $turno)
                    <option value="{{ $turno->id }}" {{ old('id_turno', $empleado->id_turno) == $turno->id ? 'selected' : '' }}>
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
                Actualizar Empleado
            </button>
            <a href="{{ route('empleados.index') }}" class="btn btn-outline" style="flex: 1; text-align: center;">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection
