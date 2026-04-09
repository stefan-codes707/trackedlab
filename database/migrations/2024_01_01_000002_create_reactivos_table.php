<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reactivos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('formula_quimica')->nullable();
            $table->decimal('cantidad', 10, 2);
            $table->string('unidad_medida');
            $table->date('fecha_caducidad')->nullable();
            $table->string('proveedor')->nullable();
            $table->string('ubicacion');
            $table->string('lote')->nullable();
            $table->string('qr_code')->unique();
            $table->text('qr_image')->nullable(); // Para guardar la imagen en base64
            $table->foreignId('registrado_por')->constrained('users');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reactivos');
    }
};