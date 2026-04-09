@extends('layouts.app')

@section('title', $reactivo->nombre)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detalles del Reactivo</h5>
                <div>
                    <a href="{{ route('reactivos.edit', $reactivo) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-2"></i>Editar
                    </a>
                    <form action="{{ route('reactivos.destroy', $reactivo) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('¿Estás seguro de eliminar este reactivo?')">
                            <i class="fas fa-trash me-2"></i>Eliminar
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Información General</h6>
                        <table class="table table-borderless">
                            <tr>
                                <th width="120">Nombre:</th>
                                <td>{{ $reactivo->nombre }}</td>
                            </tr>
                            <tr>
                                <th>Fórmula:</th>
                                <td>{{ $reactivo->formula_quimica ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Cantidad:</th>
                                <td>{{ $reactivo->cantidad }} {{ $reactivo->unidad_medida }}</td>
                            </tr>
                            <tr>
                                <th>Proveedor:</th>
                                <td>{{ $reactivo->proveedor ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted mb-2">Ubicación y Estado</h6>
                        <table class="table table-borderless">
                            <tr>
                                <th width="120">Ubicación:</th>
                                <td>{{ $reactivo->ubicacion }}</td>
                            </tr>
                            <tr>
                                <th>Lote:</th>
                                <td>{{ $reactivo->lote ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Caducidad:</th>
                                <td>
                                    {{ $reactivo->fecha_caducidad ? $reactivo->fecha_caducidad->format('d/m/Y') : 'N/A' }}
                                    @if($reactivo->caducado)
                                        <span class="badge badge-danger ms-2">Caducado</span>
                                    @elseif($reactivo->proximo_a_caducar)
                                        <span class="badge badge-warning ms-2">Próximo a caducar</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Registrado:</th>
                                <td>{{ $reactivo->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <th>Por:</th>
                                <td>{{ $reactivo->registradoPor->name }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('reactivos.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Volver a la lista
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Código QR</h5>
            </div>
            <div class="card-body text-center">
                <img src="{{ $reactivo->qr_image }}" class="img-fluid mb-3" alt="QR Code">
                <p class="text-muted small">{{ $reactivo->qr_code }}</p>
                <a href="{{ route('reactivos.download-qr', $reactivo) }}" class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>Descargar QR
                </a>
            </div>
        </div>
    </div>
</div>
@endsection