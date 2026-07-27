@extends('layouts.app')

@section('title', 'Perfil de Empleado')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Perfil de Empleado</h1>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-secondary">Editar</a>
            <a href="{{ route('empleados.index') }}" class="btn btn-outline">Volver</a>
        </div>
    </div>

    <div style="display: grid; gap: 1rem; font-size: 1rem;">
        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Nombre Completo</span>
            <div style="font-weight: 600; font-size: 1.2rem; color: var(--primary-color);">{{ $empleado->nombre_completo }}</div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Cédula de Identidad (CI)</span>
                <div style="font-weight: 600; font-size: 1.1rem;">{{ $empleado->ci }}</div>
            </div>

            <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Rol / Cargo</span>
                <div style="font-weight: 600; font-size: 1.1rem;">{{ $empleado->rol }}</div>
            </div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Correo Electrónico</span>
            <div style="font-weight: 500; color: var(--text-main);">{{ $empleado->email }}</div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Turno Asignado</span>
            <div style="font-weight: 600; color: #a5b4fc; font-size: 1.1rem;">
                {{ $empleado->turno->nombre_turno ?? 'Sin Turno' }} 
                @if($empleado->turno)
                    ({{ $empleado->turno->hora_inicio }} - {{ $empleado->turno->hora_fin }})
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
