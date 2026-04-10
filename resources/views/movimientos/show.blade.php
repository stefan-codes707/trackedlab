@extends('layouts.app')

@section('title', 'Detalle de Movimiento')

@section('content')
<div class="card-minimal" style="max-width: 600px; margin: 0 auto;">
    <div style="margin-bottom: 1.5rem;">
        <a href="{{ route('movimientos.index') }}" class="btn-minimal" style="margin-bottom: 1rem; display: inline-block;">
            <i class="fas fa-arrow-left"></i> Volver
        </a>
        <h5 style="font-size: 1rem; font-weight: 600; margin: 0;">
            <i class="fas fa-info-circle"></i> Detalle del Movimiento
        </h5>
    </div>
    
    <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 12px;">
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eaeaea;">
            <strong style="color: #8a8a8a;">Fecha:</strong>
            <span>{{ $movimiento->created_at->format('d/m/Y H:i:s') }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eaeaea;">
            <strong style="color: #8a8a8a;">Tipo:</strong>
            <span>
                @if($movimiento->tipo == 'entrada')
                    <span class="badge-minimal badge-success">📥 Entrada</span>
                @else
                    <span class="badge-minimal badge-danger">📤 Salida</span>
                @endif
            </span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eaeaea;">
            <strong style="color: #8a8a8a;">Reactivo:</strong>
            <a href="{{ route('reactivos.show', $movimiento->reactivo) }}" style="font-weight: 500;">
                {{ $movimiento->reactivo->nombre }}
            </a>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eaeaea;">
            <strong style="color: #8a8a8a;">Cantidad movida:</strong>
            <span>{{ $movimiento->cantidad }} {{ $movimiento->reactivo->unidad_medida }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eaeaea;">
            <strong style="color: #8a8a8a;">Stock antes:</strong>
            <span>{{ number_format($movimiento->cantidad_antes, 2) }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eaeaea;">
            <strong style="color: #8a8a8a;">Stock después:</strong>
            <span><strong>{{ number_format($movimiento->cantidad_despues, 2) }}</strong></span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eaeaea;">
            <strong style="color: #8a8a8a;">Motivo:</strong>
            <span>{{ $movimiento->motivo ?? 'No especificado' }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eaeaea;">
            <strong style="color: #8a8a8a;">Folio:</strong>
            <span>{{ $movimiento->folio ?? 'N/A' }}</span>
        </div>
        <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 1px solid #eaeaea;">
            <strong style="color: #8a8a8a;">Responsable:</strong>
            <span>{{ $movimiento->responsable ?? 'No especificado' }}</span>
        </div>
        <div style="display: flex; justify-content: space-between;">
            <strong style="color: #8a8a8a;">Registrado por:</strong>
            <span>{{ $movimiento->usuario->name }}</span>
        </div>
    </div>
    
    <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
        <a href="{{ route('movimientos.index') }}" class="btn-minimal" style="background-color: #8a8a8a; color: white;">
            <i class="fas fa-list"></i> Ver todos
        </a>
        <a href="{{ route('reactivos.show', $movimiento->reactivo) }}" class="btn-minimal btn-minimal-primary">
            <i class="fas fa-flask"></i> Ver Reactivo
        </a>
    </div>
</div>
@endsection