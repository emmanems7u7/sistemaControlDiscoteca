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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Relación con la tabla de usuarios (mesero que realizó el pedido)
            $table->foreignId('producto_id')->constrained();
            $table->string('mesa_id')->constrained();
            $table->timestamp('fecha_pedido');
            $table->integer('cantidad');
            $table->string('Tpago');
            $table->decimal('monto', 8, 2);
            $table->string('estado');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
