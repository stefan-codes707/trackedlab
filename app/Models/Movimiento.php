<?php
// app/Models/Movimiento.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'reactivo_id',
        'tipo',
        'cantidad',
        'cantidad_antes',
        'cantidad_despues',
        'motivo',
        'usuario_id',
        'folio',
        'responsable'
    ];

    protected $casts = [
        'cantidad' => 'decimal:2',
        'cantidad_antes' => 'decimal:2',
        'cantidad_despues' => 'decimal:2',
        'created_at' => 'datetime',
    ];

    // Relaciones
    public function reactivo()
    {
        return $this->belongsTo(Reactivo::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    // Scopes
    public function scopeEntradas($query)
    {
        return $query->where('tipo', 'entrada');
    }

    public function scopeSalidas($query)
    {
        return $query->where('tipo', 'salida');
    }

    public function scopeUltimos($query, $limit = 10)
    {
        return $query->latest()->limit($limit);
    }

    // Accesor para mostrar tipo bonito
    public function getTipoTextoAttribute()
    {
        return $this->tipo === 'entrada' ? '📥 Entrada' : '📤 Salida';
    }

    public function getTipoBadgeAttribute()
    {
        return $this->tipo === 'entrada' 
            ? '<span class="badge-minimal badge-success">Entrada</span>'
            : '<span class="badge-minimal badge-danger">Salida</span>';
    }
}