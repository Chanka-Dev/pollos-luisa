@extends('layouts.app')

@section('title', 'Clientes')

@section('content')
<div class="glass-card">
    <div class="card-header">
        <div>
            <h1 class="card-title">👥 Gestión de Clientes</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Registro y administración de clientes</p>
        </div>
        <a href="{{ route('clientes.create') }}" class="btn btn-primary">
            + Nuevo Cliente
        </a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>CI</th>
                    <th>Nombre Completo</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Fecha Nacimiento</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $cli)
                <tr>
                    <td>#{{ $cli->id }}</td>
                    <td>{{ $cli->ci }}</td>
                    <td><strong>{{ $cli->nombre_completo }}</strong></td>
                    <td>{{ $cli->email }}</td>
                    <td>{{ $cli->telefono }}</td>
                    <td>{{ \Carbon\Carbon::parse($cli->fecha_nacimiento)->format('d/m/Y') }}</td>
                    <td>
                        <div class="actions-cell">
                            <a href="{{ route('clientes.show', $cli->id) }}" class="btn btn-outline" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Ver</a>
                            <a href="{{ route('clientes.edit', $cli->id) }}" class="btn btn-secondary" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Editar</a>
                            <form action="{{ route('clientes.destroy', $cli->id) }}" method="POST" onsubmit="return confirm('¿Seguro de eliminar este cliente?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="padding: 0.3rem 0.6rem; font-size: 0.8rem;">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 2rem;">
                        No hay clientes registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
