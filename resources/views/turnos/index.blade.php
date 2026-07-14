@extends('layouts.app')

@section('title', 'Listado de Turnos')

@section('content')
<div class="glass-card">
    <div class="card-header">
        <h1 class="card-title">Turnos Registrados</h1>
        <a href="{{ route('turnos.create') }}" class="btn btn-primary">
            + Nuevo Turno
        </a>
    </div>

    <div class="table-responsive">
        @if($turnos->isEmpty())
            <div style="text-align: center; padding: 2rem; color: var(--text-muted);">
                No hay turnos registrados en el sistema. ¡Crea el primero!
            </div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Hora de Entrada</th>
                        <th>Hora de Salida</th>
                        <th>Días de Descanso</th>
                        <th>Empleados Asociados</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($turnos as $turno)
                        <tr>
                            <td>#{{ $turno->id }}</td>
                            <td><strong>{{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_entrada)->format('H:i') }}</strong></td>
                            <td><strong>{{ \Carbon\Carbon::createFromFormat('H:i:s', $turno->hora_salia)->format('H:i') }}</strong></td>
                            <td>
                                <span class="badge">{{ $turno->dias_descanso }}</span>
                            </td>
                            <td>
                                <span class="badge badge-accent">{{ $turno->empleados_count }} empleados</span>
                            </td>
                            <td>
                                <div class="actions-cell">
                                    <a href="{{ route('turnos.edit', $turno->id) }}" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.85rem;">
                                        Editar
                                    </a>
                                    <form action="{{ route('turnos.destroy', $turno->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este turno? Esto también podría eliminar a los empleados asociados.');" style="display:inline;">
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
