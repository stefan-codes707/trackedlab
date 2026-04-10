@extends('layouts.app')

@section('title', 'Movimientos de Inventario')

@section('content')
<!-- Filtros -->
<div class="card-minimal" style="margin-bottom: 2rem;">
    <form method="GET" action="{{ route('movimientos.index') }}">
        <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
            <div style="flex: 1;">
                <select name="tipo" class="form-minimal">
                    <option value="">Todos los tipos</option>
                    <option value="entrada" {{ request('tipo') == 'entrada' ? 'selected' : '' }}>📥 Entradas</option>
                    <option value="salida" {{ request('tipo') == 'salida' ? 'selected' : '' }}>📤 Salidas</option>
                </select>
            </div>
            <div style="flex: 2;">
                <select name="reactivo_id" class="form-minimal">
                    <option value="">Todos los reactivos</option>
                    @foreach($reactivos as $reactivo)
                        <option value="{{ $reactivo->id }}" {{ request('reactivo_id') == $reactivo->id ? 'selected' : '' }}>
                            {{ $reactivo->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div style="flex: 1;">
                <input type="date" name="fecha_desde" class="form-minimal" placeholder="Desde" value="{{ request('fecha_desde') }}">
            </div>
            <div style="flex: 1;">
                <input type="date" name="fecha_hasta" class="form-minimal" placeholder="Hasta" value="{{ request('fecha_hasta') }}">
            </div>
            <div>
                <button type="submit" class="btn-minimal">
                    <i class="fas fa-filter"></i>
                    Filtrar
                </button>
                <a href="{{ route('movimientos.index') }}" class="btn-minimal" style="background-color: #8a8a8a; color: white;">
                    <i class="fas fa-undo"></i>
                    Limpiar
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Tabla de Movimientos -->
<div class="card-minimal">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h5 style="font-size: 1rem; font-weight: 600; margin: 0;">
            <i class="fas fa-exchange-alt"></i> Historial de Movimientos
        </h5>
        <a href="{{ route('movimientos.create') }}" class="btn-minimal btn-minimal-primary">
            <i class="fas fa-plus"></i>
            Nuevo Movimiento
        </a>
    </div>
    
    <table class="table-minimal">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Reactivo</th>
                <th>Cantidad</th>
                <th>Stock Antes</th>
                <th>Stock Después</th>
                <th>Motivo</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movimientos as $movimiento)
            <tr>
                <td>{{ $movimiento->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if($movimiento->tipo == 'entrada')
                        <span class="badge-minimal badge-success">Entrada</span>
                    @else
                        <span class="badge-minimal badge-danger">Salida</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('reactivos.show', $movimiento->reactivo) }}" style="font-weight: 500;">
                        {{ $movimiento->reactivo->nombre }}
                    </a>
                </td>
                <td>{{ $movimiento->cantidad }} {{ $movimiento->reactivo->unidad_medida }}</td>
                <td>{{ number_format($movimiento->cantidad_antes, 2) }}</td>
                <td><strong>{{ number_format($movimiento->cantidad_despues, 2) }}</strong></td>
                <td>
                    @if($movimiento->motivo)
                        <span title="{{ $movimiento->motivo }}" style="cursor: help;">
                            {{ Str::limit($movimiento->motivo, 30) }}
                        </span>
                    @else
                        <span style="color: #8a8a8a;">—</span>
                    @endif
                </td>
                <td>{{ $movimiento->usuario->name }}</td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('movimientos.show', $movimiento) }}" class="btn-minimal" style="padding: 0.25rem 0.75rem;">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" style="text-align: center; padding: 3rem; color: #8a8a8a;">
                    <i class="fas fa-exchange-alt" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                    No hay movimientos registrados
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <!-- Paginación -->
    <div style="margin-top: 2rem;">
        {{ $movimientos->links() }}
    </div>
</div>
@endsection