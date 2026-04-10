<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Reactivo extends Model
{
    use HasFactory;

    protected $table = 'reactivos';

    protected $fillable = [
        'nombre',
        'formula_quimica',
        'cantidad',
        'unidad_medida',
        'fecha_caducidad',
        'proveedor',
        'ubicacion',
        'lote',
        'qr_code',
        'qr_image',
        'registrado_por',
        'is_active',
    ];

    protected $casts = [
        'fecha_caducidad' => 'date',
        'cantidad' => 'decimal:2',
    ];

    public function registradoPor()
    {
        return $this->belongsTo(User::class, 'registrado_por');
    }

    // Generar código QR único
    public static function generateQRCode()
    {
        return 'REACTIVO_' . uniqid() . '_' . rand(1000, 9999);
    }

    // Generar imagen QR en base64

public function getQrImageAttribute($value)
{
    if ($value) {
        return $value;
    }

    // Ahora el QR contiene la URL pública
    $qrCode = QrCode::format('svg')
        ->size(200)
        ->margin(1)
        ->generate(url('/qr/' . $this->qr_code));  // <-- URL pública
    
    return 'data:image/svg+xml;base64,' . base64_encode($qrCode);
}

    // Verificar si está próximo a caducar (30 días)
    public function getProximoACaducarAttribute()
    {
        if (!$this->fecha_caducidad) {
            return false;
        }
        
        $diasRestantes = now()->diffInDays($this->fecha_caducidad, false);
        return $diasRestantes <= 30 && $diasRestantes >= 0;
    }

    // Verificar si está caducado
    public function getCaducadoAttribute()
    {
        if (!$this->fecha_caducidad) {
            return false;
        }
        
        return now()->greaterThan($this->fecha_caducidad);
    }

public function movimientos()
{
    return $this->hasMany(Movimiento::class)->latest();
}
}