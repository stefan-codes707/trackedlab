<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $reactivo->nombre }} | TrackedLab</title>
    
    <!-- Fuente Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .qr-card {
            max-width: 480px;
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        /* Header con logo */
        .qr-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 2rem;
            text-align: center;
            color: white;
        }
        
        .qr-logo {
            width: 64px;
            height: 64px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            backdrop-filter: blur(10px);
        }
        
        .qr-logo i {
            font-size: 2rem;
            color: white;
        }
        
        .qr-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .qr-header p {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        /* Contenido */
        .qr-content {
            padding: 2rem;
        }
        
        /* Información del reactivo */
        .info-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .info-row {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 12px;
        }
        
        .info-icon {
            width: 36px;
            height: 36px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #667eea;
            font-size: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }
        
        .info-details {
            flex: 1;
        }
        
        .info-label {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #8a8a8a;
            margin-bottom: 0.15rem;
        }
        
        .info-value {
            font-size: 1rem;
            font-weight: 500;
            color: #1a1a1a;
            line-height: 1.4;
        }
        
        /* Estado badge */
        .status-badge {
            display: inline-block;
            padding: 0.35rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.02em;
        }
        
        .status-vigente {
            background: #ecfdf3;
            color: #067647;
            border: 1px solid #abefc6;
        }
        
        .status-proximo {
            background: #fffaeb;
            color: #b54708;
            border: 1px solid #fedf89;
        }
        
        .status-caducado {
            background: #fef3f2;
            color: #b42318;
            border: 1px solid #fecdca;
        }
        
        /* QR pequeño */
        .qr-mini {
            text-align: center;
            padding-top: 1.5rem;
            margin-top: 1rem;
            border-top: 1px solid #eaeaea;
        }
        
        .qr-mini img {
            width: 80px;
            height: 80px;
            margin-bottom: 0.5rem;
        }
        
        .qr-mini p {
            font-size: 0.7rem;
            color: #8a8a8a;
            word-break: break-all;
        }
        
        /* Footer */
        .qr-footer {
            padding: 1rem 2rem 2rem;
            text-align: center;
            color: #8a8a8a;
            font-size: 0.8rem;
            border-top: 1px solid #eaeaea;
        }
        
        .qr-footer i {
            color: #667eea;
            margin: 0 0.25rem;
        }
    </style>
</head>
<body>
    <div class="qr-card">
        <!-- Header con logo -->
        <div class="qr-header">
            <div class="qr-logo">
                <i class="fas fa-flask"></i>
            </div>
            <h1>TrackedLab</h1>
            <p>Sistema de Gestión de Reactivos</p>
        </div>
        
        <!-- Contenido -->
        <div class="qr-content">
            <!-- Nombre del reactivo -->
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h2 style="font-size: 1.5rem; font-weight: 600; color: #1a1a1a; margin-bottom: 0.25rem;">
                    {{ $reactivo->nombre }}
                </h2>
                @if($reactivo->formula_quimica)
                    <p style="color: #8a8a8a; font-size: 0.9rem;">{{ $reactivo->formula_quimica }}</p>
                @endif
            </div>
            
            <!-- Estado -->
            <div style="text-align: center; margin-bottom: 1.5rem;">
                @if($reactivo->caducado)
                    <span class="status-badge status-caducado">
                        <i class="fas fa-exclamation-triangle" style="margin-right: 0.35rem;"></i>
                        CADUCADO
                    </span>
                @elseif($reactivo->proximo_a_caducar)
                    <span class="status-badge status-proximo">
                        <i class="fas fa-clock" style="margin-right: 0.35rem;"></i>
                        PRÓXIMO A CADUCAR
                    </span>
                @else
                    <span class="status-badge status-vigente">
                        <i class="fas fa-check-circle" style="margin-right: 0.35rem;"></i>
                        VIGENTE
                    </span>
                @endif
            </div>
            
            <!-- Grid de información -->
            <div class="info-grid">
                <!-- Cantidad -->
                <div class="info-row">
                    <div class="info-icon">
                        <i class="fas fa-flask"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Cantidad</div>
                        <div class="info-value">{{ $reactivo->cantidad }} {{ $reactivo->unidad_medida }}</div>
                    </div>
                </div>
                
                <!-- Ubicación -->
                <div class="info-row">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Ubicación</div>
                        <div class="info-value">{{ $reactivo->ubicacion }}</div>
                    </div>
                </div>
                
                <!-- Lote -->
                @if($reactivo->lote)
                <div class="info-row">
                    <div class="info-icon">
                        <i class="fas fa-barcode"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Lote</div>
                        <div class="info-value">{{ $reactivo->lote }}</div>
                    </div>
                </div>
                @endif
                
                <!-- Proveedor -->
                @if($reactivo->proveedor)
                <div class="info-row">
                    <div class="info-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Proveedor</div>
                        <div class="info-value">{{ $reactivo->proveedor }}</div>
                    </div>
                </div>
                @endif
                
                <!-- Fecha de caducidad -->
                @if($reactivo->fecha_caducidad)
                <div class="info-row">
                    <div class="info-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="info-details">
                        <div class="info-label">Fecha de Caducidad</div>
                        <div class="info-value">
                            {{ $reactivo->fecha_caducidad->format('d/m/Y') }}
                            @if(!$reactivo->caducado)
                                @php
                                    $diasRestantes = now()->diffInDays($reactivo->fecha_caducidad, false);
                                @endphp
                                <span style="display: block; font-size: 0.8rem; color: #8a8a8a; margin-top: 0.15rem;">
                                    {{ floor($diasRestantes) }} días restantes
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            <!-- QR pequeño (para referencia) -->
            <div class="qr-mini">
                <img src="{{ $reactivo->qr_image }}" alt="QR Code">
                <p>{{ $reactivo->qr_code }}</p>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="qr-footer">
            <i class="fas fa-flask"></i> TrackedLab · Sistema de Gestión de Reactivos
        </div>
    </div>
</body>
</html>