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
        Schema::table('cotizaciones', function (Blueprint $table) {
            // Campos para el diseñador de tazas 3D
            if (!Schema::hasColumn('cotizaciones', 'tipo_producto')) {
                $table->string('tipo_producto')->nullable();
            }
            
            if (!Schema::hasColumn('cotizaciones', 'imagen_diseño')) {
                $table->longText('imagen_diseño')->nullable(); // longText para base64 de PNG
            }
            
            if (!Schema::hasColumn('cotizaciones', 'color_producto')) {
                $table->string('color_producto')->nullable();
            }
            
            if (!Schema::hasColumn('cotizaciones', 'descripcion')) {
                $table->text('descripcion')->nullable();
            }
            
            if (!Schema::hasColumn('cotizaciones', 'notas')) {
                $table->json('notas')->nullable(); // JSON para guardar metadatos del diseño
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cotizaciones', function (Blueprint $table) {
            if (Schema::hasColumn('cotizaciones', 'tipo_producto')) {
                $table->dropColumn('tipo_producto');
            }
            if (Schema::hasColumn('cotizaciones', 'imagen_diseño')) {
                $table->dropColumn('imagen_diseño');
            }
            if (Schema::hasColumn('cotizaciones', 'color_producto')) {
                $table->dropColumn('color_producto');
            }
            if (Schema::hasColumn('cotizaciones', 'descripcion')) {
                $table->dropColumn('descripcion');
            }
            if (Schema::hasColumn('cotizaciones', 'notas')) {
                $table->dropColumn('notas');
            }
        });
    }
};
