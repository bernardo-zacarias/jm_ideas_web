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
        Schema::table('items_pedido', function (Blueprint $table) {
            // Agregar columna design_data solo si no existe
            if (!Schema::hasColumn('items_pedido', 'design_data')) {
                $table->longText('design_data')->nullable()->comment('Datos JSON del diseño personalizado');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items_pedido', function (Blueprint $table) {
            if (Schema::hasColumn('items_pedido', 'design_data')) {
                $table->dropColumn('design_data');
            }
        });
    }
};
