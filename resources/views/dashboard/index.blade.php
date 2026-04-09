@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-item">
        <div class="stat-label">Total Reactivos</div>
        <div class="stat-value">{{ $totalReactivos }}</div>
    </div>
    
    <div class="stat-item">
        <div class="stat-label">Próximos a Caducar</div>
        <div class="stat-value">{{ $reactivosPorCaducar }}</div>
    </div>
    
    <div class="stat-item">
        <div class="stat-label">Caducados</div>
        <div class="stat-value">{{ $reactivosCaducados }}</div>
    </div>
    
    <div class="stat-item">
        <div class="stat-label">Total Unidades</div>
        <div class="stat-value">{{ number_format($totalUnidades, 2) }}</div>
    </div>
</div>

<!-- Últimos Reactivos -->
<div class="card-minimal" style="margin-bottom: 2rem;">
    <h5 style="font-size: 1rem; font-weight: 600; margin-bottom: 1.5rem; color: #1a1a1a;">Últimos Reactivos</h5>
    
    <table class="table-minimal">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ubicación</th>
                <th>Cantidad</th>
                <th>Caducidad</th>
                <th>Registrado por</th>
            </tr>
        </thead>
        <tbody>
            @forelse($ultimosReactivos as $reactivo)
            <tr>
                <td>
                    <a href="{{ route('reactivos.show', $reactivo) }}" style="font-weight: 500;">
                        {{ $reactivo->nombre }}
                    </a>
                </td>
                <td>{{ $reactivo->ubicacion }}</td>
                <td>{{ $reactivo->cantidad }} {{ $reactivo->unidad_medida }}</td>
                <td>
                    @if($reactivo->caducado)
                        <span class="badge-minimal badge-danger">Caducado</span>
                    @elseif($reactivo->proximo_a_caducar)
                        <span class="badge-minimal badge-warning">{{ $reactivo->fecha_caducidad->format('d/m/Y') }}</span>
                    @else
                        {{ $reactivo->fecha_caducidad ? $reactivo->fecha_caducidad->format('d/m/Y') : 'N/A' }}
                    @endif
                </td>
                <td>{{ $reactivo->registradoPor->name }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center; color: #8a8a8a;">No hay reactivos registrados</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Reactivos por Ubicación -->
<div class="card-minimal">
    <h5 style="font-size: 1rem; font-weight: 600; margin-bottom: 1.5rem; color: #1a1a1a;">Reactivos por Ubicación</h5>
    
    <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
        @forelse($reactivosPorUbicacion as $ubicacion)
        <div style="flex: 1; min-width: 120px;">
            <div style="font-size: 0.8rem; color: #8a8a8a; margin-bottom: 0.25rem;">{{ $ubicacion->ubicacion }}</div>
            <div style="font-size: 1.25rem; font-weight: 600;">{{ $ubicacion->total }}</div>
        </div>
        @empty
        <div style="color: #8a8a8a;">No hay datos</div>
        @endforelse
    </div>
</div>
@endsection