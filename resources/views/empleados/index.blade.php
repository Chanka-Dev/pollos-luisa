@extends('layouts.app')

@section('title', 'Listado de Empleados')

@section('content')
<div class="glass-card">
    <div class="card-header">
        <h1 class="card-title">Personal de Trabajo (Empleados)</h1>
        <a href="{{ route('empleados.create') }}" class="btn btn-primary">
            + Registrar Empleado
        </a>
    </div>

    <div class="table-responsive">
        @if($empleados->isEmpty())
            <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
                No hay empleados registrados en el sistema. ¡Registra al primero!
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CI (Cédula)</th>
                        <th>Nombre Completo</th>
                        <th>Email</th>
                        <th>Rol / Puesto</th>
                        <th>Turno Asignado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($empleados as $empleado)
                        <tr>
                            <td>#{{ $empleado->id }}</td>
                            <td>{{ $empleado->ci }}</td>
                            <td><strong>{{ $empleado->nombre_completo }}</strong></td>
                            <td>{{ $empleado->email }}</td>
                            <td>
                                <span class="badge">{{ $empleado->rol }}</span>
                            </td>
                            <td>
                                @if($empleado->turno)
                                    <div style="font-size: 0.85rem;">
                                        <strong>{{ \Carbon\Carbon::createFromFormat('H:i:s', $empleado->turno->hora_entrada)->format('H:i') }} - {{ \Carbon\Carbon::createFromFormat('H:i:s', $empleado->turno->hora_salia)->format('H:i') }}</strong>
                                        <div style="color: var(--text-muted); font-size: 0.75rem;">Descanso: {{ $empleado->turno->dias_descanso }}</div>
                                    </div>
                                @else
                                    <span style="color: var(--accent-red); font-size: 0.85rem;">Sin turno asignado</span>
                                @endif
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">
                                        Editar
                                    </a>
                                    <form action="{{ route('empleados.destroy', $empleado->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar a este empleado?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
