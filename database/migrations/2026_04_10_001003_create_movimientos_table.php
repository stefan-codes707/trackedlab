<?php
// database/migrations/2026_04_10_000001_create_movimientos_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reactivo_id')->constrained()->onDelete('cascade');
            $table->enum('tipo', ['entrada', 'salida']);
            $table->decimal('cantidad', 10, 2);
            $table->decimal('cantidad_antes', 10, 2);
            $table->decimal('cantidad_despues', 10, 2);
            $table->text('motivo')->nullable();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('folio')->nullable(); // Número de referencia (opcional)
            $table->string('responsable')->nullable(); // Quién recibió/entregó
            $table->timestamps();
            
            // Índices para búsquedas rápidas
            $table->index(['reactivo_id', 'tipo', 'created_at']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
};