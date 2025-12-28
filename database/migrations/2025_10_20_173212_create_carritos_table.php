<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuta las migraciones.
     */
    public function up(): void
    {
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            // Clave foránea al Usuario (nullable para carritos de visitantes)
            $table->foreignId('usuario_id')->nullable()->constrained('users')->onDelete('cascade');
            
            // Código único del carrito (para visitantes)
            $table->string('codigo_carrito')->nullable()->unique();
            
            // Estado del carrito
            $table->enum('estado', ['activo', 'completado', 'abandonado'])->default('activo');
            
            // Si se marcó la opción de diseño
            $table->boolean('requiere_diseno')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Revierte las migraciones.
     */
    public function down(): void
    {
        Schema::dropIfExists('carritos');
    }
};