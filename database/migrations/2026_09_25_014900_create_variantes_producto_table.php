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
        Schema::create('variantes_producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->restrictOnDelete();
            $table->string('codigo', 50)->unique();
            $table->string('color', 60);
            $table->decimal('talla_us', 4, 1);
            $table->unsignedInteger('existencia_pares')->default(0);
            $table->unsignedInteger('stock_minimo_pares')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();

            $table->unique(['producto_id', 'color', 'talla_us']);
            $table->index(['producto_id', 'activo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variantes_producto');
    }
};
