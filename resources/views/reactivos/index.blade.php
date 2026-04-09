@extends('layouts.app')

@section('title', 'Reactivos')

@section('content')
<!-- Filtros -->
<div class="card-minimal" style="margin-bottom: 2rem;">
    <form method="GET" action="{{ route('reactivos.index') }}">
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <div style="flex: 2;">
                <input type="text" name="search" class="form-minimal" placeholder="Buscar por nombre, fórmula o ubicación..." value="{{ request('search') }}">
            </div>
            <div style="flex: 1;">
                <select name="ubicacion" class="form-minimal">
                    <option value="">Todas las ubicaciones</option>
                    @foreach($ubicaciones as $ubicacion)
                        <option value="{{ $ubicacion }}" {{ request('ubicacion') == $ubicacion ? 'selected' : '' }}>
                            {{ $ubicacion }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div style="flex: 1;">
                <select name="estado" class="form-minimal">
                    <option value="">Todos los estados</option>
                    <option value="proximo" {{ request('estado') == 'proximo' ? 'selected' : '' }}>Próximos a caducar</option>
                    <option value="caducado" {{ request('estado') == 'caducado' ? 'selected' : '' }}>Caducados</option>
                </select>
            </div>
            <div>
                <button type="submit" class="btn-minimal">
                    <i class="fas fa-filter"></i>
                    Filtrar
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Tabla de Reactivos -->
<div class="card-minimal">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h5 style="font-size: 1rem; font-weight: 600; margin: 0;">Lista de Reactivos</h5>
        <a href="{{ route('reactivos.create') }}" class="btn-minimal btn-minimal-primary">
            <i class="fas fa-plus"></i>
            Nuevo Reactivo
        </a>
    </div>
    
    <table class="table-minimal">
        <thead>
            <tr>
                <th>QR</th>
                <th>Nombre</th>
                <th>Fórmula</th>
                <th>Cantidad</th>
                <th>Ubicación</th>
                <th>Caducidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reactivos as $reactivo)
            <tr>
                <td>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#qrModal{{ $reactivo->id }}" style="color: #3b82f6;">
                        <i class="fas fa-qrcode" style="font-size: 1.25rem;"></i>
                    </a>
                    
                    <!-- Modal QR -->
                    <div class="modal fade" id="qrModal{{ $reactivo->id }}" tabindex="-1">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content" style="border-radius: 12px;">
                                <div class="modal-header" style="border-bottom: 1px solid #eaeaea;">
                                    <h5 class="modal-title" style="font-size: 1rem;">{{ $reactivo->nombre }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ $reactivo->qr_image }}" class="img-fluid mb-3" alt="QR Code" style="max-width: 180px;">
                                    <p style="font-size: 0.75rem; color: #8a8a8a; word-break: break-all;">{{ $reactivo->qr_code }}</p>
                                    <a href="{{ route('reactivos.download-qr', $reactivo) }}" class="btn-minimal" style="width: 100%;">
                                        <i class="fas fa-download"></i>
                                        Descargar
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <a href="{{ route('reactivos.show', $reactivo) }}" style="font-weight: 500;">
                        {{ $reactivo->nombre }}
                    </a>
                </td>
                <td>{{ $reactivo->formula_quimica ?? '—' }}</td>
                <td>{{ $reactivo->cantidad }} {{ $reactivo->unidad_medida }}</td>
                <td>{{ $reactivo->ubicacion }}</td>
                <td>{{ $reactivo->fecha_caducidad ? $reactivo->fecha_caducidad->format('d/m/Y') : '—' }}</td>
                <td>
                    @if($reactivo->caducado)
                        <span class="badge-minimal badge-danger">Caducado</span>
                    @elseif($reactivo->proximo_a_caducar)
                        <span class="badge-minimal badge-warning">Próximo</span>
                    @else
                        <span class="badge-minimal badge-success">Vigente</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('reactivos.edit', $reactivo) }}" class="btn-minimal" style="padding: 0.25rem 0.75rem;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('reactivos.destroy', $reactivo) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-minimal" style="padding: 0.25rem 0.75rem; color: #b42318;" onclick="return confirm('¿Eliminar este reactivo?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 3rem; color: #8a8a8a;">
                    <i class="fas fa-flask" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                    No hay reactivos registrados
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Paginación -->
    <div style="margin-top: 2rem;">
        {{ $reactivos->links() }}
    </div>
</div>
@endsection