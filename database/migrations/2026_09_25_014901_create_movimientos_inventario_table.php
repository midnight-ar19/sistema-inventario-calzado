<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movimientos_inventario', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variante_id')->constrained('variantes_producto')->restrictOnDelete();
            $table->foreignId('usuario_id')->constrained('users')->restrictOnDelete();
            $table->enum('tipo', ['entrada', 'salida', 'existencia_inicial', 'ajuste']);
            $table->integer('cambio_pares');
            $table->unsignedInteger('saldo_anterior');
            $table->unsignedInteger('saldo_resultante');
            $table->string('motivo', 255);
            $table->timestamp('ocurrido_en');
            $table->timestamps();

            $table->index(['variante_id', 'ocurrido_en']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos_inventario');
    }
};
