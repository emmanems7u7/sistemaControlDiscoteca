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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('imagen');
            $table->text('descripcion')->nullable();
            $table->foreignId('categoria_id')->constrained(); // Relación con la tabla de categorías
            $table->foreignId('proovedor_id')->constrained(); // Relación con la tabla de proveedores
            $table->decimal('precio_compra', 8, 2);
            $table->decimal('precio_venta', 8, 2);
            $table->integer('cantidad_stock');
            $table->string('unidad');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
