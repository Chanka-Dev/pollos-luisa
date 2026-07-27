@extends('layouts.app')

@section('title', 'Detalles del Cliente')

@section('content')
<div class="glass-card" style="max-width: 600px; margin: 0 auto;">
    <div class="card-header">
        <h1 class="card-title">Detalles del Cliente</h1>
        <div style="display: flex; gap: 0.5rem;">
            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-secondary">Editar</a>
            <a href="{{ route('clientes.index') }}" class="btn btn-outline">Volver</a>
        </div>
    </div>

    <div style="display: grid; gap: 1rem; font-size: 1rem;">
        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">ID Cliente</span>
            <div style="font-weight: 600;">#{{ $cliente->id }}</div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Nombre Completo</span>
            <div style="font-weight: 600; font-size: 1.2rem; color: var(--primary-color);">{{ $cliente->nombre_completo }}</div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">CI</span>
                <div style="font-weight: 600; font-size: 1.1rem;">{{ $cliente->ci }}</div>
            </div>

            <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
                <span style="color: var(--text-muted); font-size: 0.85rem;">Teléfono</span>
                <div style="font-weight: 600; font-size: 1.1rem;">{{ $cliente->telefono }}</div>
            </div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Email</span>
            <div style="font-weight: 600;">{{ $cliente->email }}</div>
        </div>

        <div style="padding: 0.75rem; background: rgba(255,255,255,0.02); border-radius: 8px;">
            <span style="color: var(--text-muted); font-size: 0.85rem;">Fecha de Nacimiento</span>
            <div style="font-weight: 600;">{{ \Carbon\Carbon::parse($cliente->fecha_nacimiento)->format('d/m/Y') }}</div>
        </div>
    </div>
</div>
@endsection
