@extends('layouts.app')

@section('title', 'Nuevo Reactivo')

@section('content')
<div style="max-width: 800px;">
    <div class="card-minimal">
        <form method="POST" action="{{ route('reactivos.store') }}">
            @csrf
            
            <div style="margin-bottom: 2rem;">
                <h5 style="font-size: 1rem; font-weight: 600; margin-bottom: 1.5rem;">Información del Reactivo</h5>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Nombre *</label>
                        <input type="text" name="nombre" class="form-minimal" value="{{ old('nombre') }}" required>
                        @error('nombre') <span style="color: #b42318; font-size: 0.75rem;">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Fórmula Química</label>
                        <input type="text" name="formula_quimica" class="form-minimal" value="{{ old('formula_quimica') }}">
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Cantidad *</label>
                        <input type="number" step="0.01" name="cantidad" class="form-minimal" value="{{ old('cantidad') }}" required>
                    </div>
                    
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Unidad *</label>
                        <select name="unidad_medida" class="form-minimal" required>
                            <option value="">Seleccionar</option>
                            <option value="ml" {{ old('unidad_medida') == 'ml' ? 'selected' : '' }}>ml</option>
                            <option value="l" {{ old('unidad_medida') == 'l' ? 'selected' : '' }}>l</option>
                            <option value="g" {{ old('unidad_medida') == 'g' ? 'selected' : '' }}>g</option>
                            <option value="kg" {{ old('unidad_medida') == 'kg' ? 'selected' : '' }}>kg</option>
                            <option value="mg" {{ old('unidad_medida') == 'mg' ? 'selected' : '' }}>mg</option>
                            <option value="mol" {{ old('unidad_medida') == 'mol' ? 'selected' : '' }}>mol</option>
                        </select>
                    </div>
                    
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Caducidad</label>
                        <input type="date" name="fecha_caducidad" class="form-minimal" value="{{ old('fecha_caducidad') }}">
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem;">
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Proveedor</label>
                        <input type="text" name="proveedor" class="form-minimal" value="{{ old('proveedor') }}">
                    </div>
                    
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Ubicación *</label>
                        <input type="text" name="ubicacion" class="form-minimal" value="{{ old('ubicacion') }}" required>
                    </div>
                </div>
                
                <div style="margin-bottom: 1rem;">
                    <label style="display: block; font-size: 0.85rem; font-weight: 500; margin-bottom: 0.5rem; color: #4a4a4a;">Lote</label>
                    <input type="text" name="lote" class="form-minimal" value="{{ old('lote') }}">
                </div>
            </div>
            
            <div style="display: flex; gap: 1rem; justify-content: flex-end; border-top: 1px solid #eaeaea; padding-top: 1.5rem;">
                <a href="{{ route('reactivos.index') }}" class="btn-minimal">Cancelar</a>
                <button type="submit" class="btn-minimal btn-minimal-primary">
                    <i class="fas fa-save"></i>
                    Guardar Reactivo
                </button>
            </div>
        </form>
    </div>
</div>
@endsection