@extends('layouts.app')

@section('title', 'Registrar Movimiento')

@section('content')
<div class="card-minimal" style="max-width: 600px; margin: 0 auto;">
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('movimientos.index') }}" class="btn-minimal" style="margin-bottom: 1rem; display: inline-block;">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h5 style="font-size: 1rem; font-weight: 600; margin: 0;">
            <i class="fas fa-exchange-alt"></i> Nuevo Movimiento
        </h5>
    </div>
    
    <form action="{{ route('movimientos.store') }}" method="POST">
        @csrf
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; font-weight: 500;">Reactivo *</label>
            <select name="reactivo_id" class="form-minimal" required>
                <option value="">Seleccione un reactivo</option>
                @foreach($reactivos as $reactivo)
                <option value="{{ $reactivo->id }}" {{ old('reactivo_id') == $reactivo->id ? 'selected' : '' }}>
                    {{ $reactivo->nombre }} (Stock: {{ $reactivo->cantidad }} {{ $reactivo->unidad_medida }})
                </option>
                @endforeach
            </select>
            @error('reactivo_id')
                <small style="color: #dc2626;">{{ $message }}</small>
            @enderror
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; font-weight: 500;">Tipo de Movimiento *</label>
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="radio" name="tipo" value="entrada" {{ old('tipo') == 'entrada' ? 'checked' : '' }} required> 
                    <span class="badge-minimal badge-success">📥 Entrada (Agregar stock)</span>
                </label>
                <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                    <input type="radio" name="tipo" value="salida" {{ old('tipo') == 'salida' ? 'checked' : '' }} required> 
                    <span class="badge-minimal badge-danger">📤 Salida (Retirar stock)</span>
                </label>
            </div>
            @error('tipo')
                <small style="color: #dc2626;">{{ $message }}</small>
            @enderror
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; font-weight: 500;">Cantidad *</label>
            <input type="number" name="cantidad" step="0.01" class="form-minimal" value="{{ old('cantidad') }}" placeholder="0.00" required>
            @error('cantidad')
                <small style="color: #dc2626;">{{ $message }}</small>
            @enderror
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; font-weight: 500;">Motivo</label>
            <textarea name="motivo" rows="3" class="form-minimal" placeholder="Ej: Compra mensual, Consumo en pruebas, Donación, etc.">{{ old('motivo') }}</textarea>
            @error('motivo')
                <small style="color: #dc2626;">{{ $message }}</small>
            @enderror
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; font-weight: 500;">Número de Folio/Referencia</label>
            <input type="text" name="folio" class="form-minimal" value="{{ old('folio') }}" placeholder="Opcional">
            @error('folio')
                <small style="color: #dc2626;">{{ $message }}</small>
            @enderror
        </div>
        
        <div style="margin-bottom: 1rem;">
            <label style="display: block; margin-bottom: 0.5rem; font-size: 0.9rem; font-weight: 500;">Responsable (Quién recibe/entrega)</label>
            <input type="text" name="responsable" class="form-minimal" value="{{ old('responsable') }}" placeholder="Opcional">
            @error('responsable')
                <small style="color: #dc2626;">{{ $message }}</small>
            @enderror
        </div>
        
        <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
            <button type="submit" class="btn-minimal btn-minimal-primary">
                <i class="fas fa-save"></i> Registrar Movimiento
            </button>
            <a href="{{ route('movimientos.index') }}" class="btn-minimal" style="background-color: #8a8a8a; color: white;">
                Cancelar
            </a>
        </div>
    </form>
</div>
@endsection