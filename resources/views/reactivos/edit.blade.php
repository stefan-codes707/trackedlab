@extends('layouts.app')

@section('title', 'Editar Reactivo')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Editar Reactivo: {{ $reactivo->nombre }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('reactivos.update', $reactivo) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre del Reactivo *</label>
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                                   id="nombre" name="nombre" value="{{ old('nombre', $reactivo->nombre) }}" required>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="formula_quimica" class="form-label">Fórmula Química</label>
                            <input type="text" class="form-control @error('formula_quimica') is-invalid @enderror" 
                                   id="formula_quimica" name="formula_quimica" value="{{ old('formula_quimica', $reactivo->formula_quimica) }}">
                            @error('formula_quimica')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="cantidad" class="form-label">Cantidad *</label>
                            <input type="number" step="0.01" class="form-control @error('cantidad') is-invalid @enderror" 
                                   id="cantidad" name="cantidad" value="{{ old('cantidad', $reactivo->cantidad) }}" required>
                            @error('cantidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="unidad_medida" class="form-label">Unidad *</label>
                            <select class="form-select @error('unidad_medida') is-invalid @enderror" 
                                    id="unidad_medida" name="unidad_medida" required>
                                <option value="">Seleccione...</option>
                                <option value="ml" {{ (old('unidad_medida', $reactivo->unidad_medida) == 'ml') ? 'selected' : '' }}>ml</option>
                                <option value="l" {{ (old('unidad_medida', $reactivo->unidad_medida) == 'l') ? 'selected' : '' }}>l</option>
                                <option value="g" {{ (old('unidad_medida', $reactivo->unidad_medida) == 'g') ? 'selected' : '' }}>g</option>
                                <option value="kg" {{ (old('unidad_medida', $reactivo->unidad_medida) == 'kg') ? 'selected' : '' }}>kg</option>
                                <option value="mg" {{ (old('unidad_medida', $reactivo->unidad_medida) == 'mg') ? 'selected' : '' }}>mg</option>
                                <option value="mol" {{ (old('unidad_medida', $reactivo->unidad_medida) == 'mol') ? 'selected' : '' }}>mol</option>
                            </select>
                            @error('unidad_medida')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="fecha_caducidad" class="form-label">Fecha de Caducidad</label>
                            <input type="date" class="form-control @error('fecha_caducidad') is-invalid @enderror" 
                                   id="fecha_caducidad" name="fecha_caducidad" 
                                   value="{{ old('fecha_caducidad', $reactivo->fecha_caducidad ? $reactivo->fecha_caducidad->format('Y-m-d') : '') }}">
                            @error('fecha_caducidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="proveedor" class="form-label">Proveedor</label>
                            <input type="text" class="form-control @error('proveedor') is-invalid @enderror" 
                                   id="proveedor" name="proveedor" value="{{ old('proveedor', $reactivo->proveedor) }}">
                            @error('proveedor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="ubicacion" class="form-label">Ubicación *</label>
                            <input type="text" class="form-control @error('ubicacion') is-invalid @enderror" 
                                   id="ubicacion" name="ubicacion" value="{{ old('ubicacion', $reactivo->ubicacion) }}" required>
                            @error('ubicacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="lote" class="form-label">Número de Lote</label>
                            <input type="text" class="form-control @error('lote') is-invalid @enderror" 
                                   id="lote" name="lote" value="{{ old('lote', $reactivo->lote) }}">
                            @error('lote')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('reactivos.show', $reactivo) }}" class="btn btn-secondary">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Actualizar Reactivo
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection