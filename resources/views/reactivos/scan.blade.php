@extends('layouts.app')

@section('title', 'Escanear QR')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Escanear Código QR</h5>
            </div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="fas fa-qrcode fa-4x text-primary"></i>
                </div>
                
                <div id="reader" style="width: 100%;"></div>
                
                <div class="mt-4" id="result"></div>

                <div class="mt-4">
                    <p class="text-muted">O ingresa el código manualmente:</p>
                    <div class="input-group">
                        <input type="text" id="manual_qr" class="form-control" placeholder="Código QR">
                        <button class="btn btn-primary" onclick="verificarQR()">
                            <i class="fas fa-search me-2"></i>Buscar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
<script>
let html5QrcodeScanner = null;

function onScanSuccess(decodedText, decodedResult) {
    // Detener el escáner
    if (html5QrcodeScanner) {
        html5QrcodeScanner.clear();
    }
    
    // Redirigir a la página pública del reactivo
    window.location.href = `/qr/${decodedText}`;
}

function verificarQR() {
    const qrCode = document.getElementById('manual_qr').value;
    if (qrCode) {
        window.location.href = `/qr/${qrCode}`;
    }
}

function verificarQRCode(qrCode) {
    fetch('{{ route("reactivos.verify-qr") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ qr_code: qrCode })
    })
    .then(response => response.json())
    .then(data => {
        const resultDiv = document.getElementById('result');
        if (data.success) {
            resultDiv.innerHTML = `
                <div class="alert alert-success">
                    <h6 class="alert-heading">¡Reactivo encontrado!</h6>
                    <p><strong>${data.reactivo.nombre}</strong></p>
                    <p>Cantidad: ${data.reactivo.cantidad} ${data.reactivo.unidad_medida}</p>
                    <p>Ubicación: ${data.reactivo.ubicacion}</p>
                    <a href="${data.url}" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye me-2"></i>Ver detalles
                    </a>
                </div>
            `;
        } else {
            resultDiv.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    ${data.message}
                </div>
            `;
        }
    });
}

// Inicializar escáner cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { 
            fps: 10, 
            qrbox: { width: 250, height: 250 },
            rememberLastUsedCamera: true
        }
    );
    html5QrcodeScanner.render(onScanSuccess);
});
</script>
@endpush