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

<!-- NUEVO: ACORDEÓN DE REACTIVOS A CADUCAR -->
<div class="card-minimal" style="margin-bottom: 2rem;">
    <div style="cursor: pointer; display: flex; justify-content: space-between; align-items: center;" onclick="toggleAcordeon()">
        <h5 style="font-size: 1rem; font-weight: 600; margin: 0; color: #1a1a1a;">
            <i class="fas fa-exclamation-triangle" style="color: #f59e0b; margin-right: 0.5rem;"></i>
            Reactivos a punto de caducar ({{ $reactivosProximosCaducar->count() }})
        </h5>
        <i id="acordeonIcon" class="fas fa-chevron-down" style="color: #8a8a8a; transition: transform 0.3s;"></i>
    </div>
    
    <div id="acordeonContent" style="display: none; margin-top: 1.5rem;">
        @if($reactivosProximosCaducar->count() > 0)
            <table class="table-minimal">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Cantidad</th>
                        <th>Lote</th>
                        <th>Fecha Caducidad</th>
                        <th>Días restantes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reactivosProximosCaducar as $reactivo)
                    <tr>
                        <td>
                            <a href="{{ route('reactivos.show', $reactivo) }}" style="font-weight: 500;">
                                {{ $reactivo->nombre }}
                            </a>
                        </td>
                        <td>{{ $reactivo->ubicacion }}</td>
                        <td>{{ $reactivo->cantidad }} {{ $reactivo->unidad_medida }}</td>
                        <td>{{ $reactivo->lote ?? 'N/A' }}</td>
                        <td>
                            <span class="badge-minimal badge-warning">
                                {{ $reactivo->fecha_caducidad->format('d/m/Y') }}
                            </span>
                        </td>
                        <td>
                            @php
                                $diasRestantes = ceil(now()->diffInDays($reactivo->fecha_caducidad, false));
                            @endphp
                            @if($diasRestantes <= 0)
                                <span class="badge-minimal badge-danger">Caducado</span>
                            @elseif($diasRestantes <= 30)
                                <span class="badge-minimal badge-danger">{{ $diasRestantes }} días</span>
                            @elseif($diasRestantes <= 60)
                                <span class="badge-minimal badge-warning">{{ $diasRestantes }} días</span>
                            @else
                                <span class="badge-minimal badge-info">{{ $diasRestantes }} días</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="text-align: center; padding: 2rem; color: #8a8a8a;">
                <i class="fas fa-check-circle" style="font-size: 2rem; margin-bottom: 0.5rem; color: #10b981;"></i>
                <p>No hay reactivos próximos a caducar</p>
            </div>
        @endif
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

<script>
function toggleAcordeon() {
    var content = document.getElementById('acordeonContent');
    var icon = document.getElementById('acordeonIcon');
    
    if (content.style.display === 'none' || content.style.display === '') {
        content.style.display = 'block';
        icon.style.transform = 'rotate(180deg)';
    } else {
        content.style.display = 'none';
        icon.style.transform = 'rotate(0deg)';
    }
}
</script>
@endsection