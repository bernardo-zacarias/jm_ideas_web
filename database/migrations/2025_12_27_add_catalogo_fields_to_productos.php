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
        Schema::table('productos', function (Blueprint $table) {
            // Campos para laminado
            $table->decimal('precio_laminado', 10, 2)->nullable()->after('precio');
            
            // Campo para medida/tamaño
            $table->string('medida')->nullable()->after('precio_laminado');
            
            // Campos para precios de mayoreo
            $table->decimal('precio_mayoreo', 10, 2)->nullable()->after('medida');
            $table->decimal('precio_mayoreo_laminado', 10, 2)->nullable()->after('precio_mayoreo');
            $table->integer('cantidad_mayoreo')->nullable()->after('precio_mayoreo_laminado');
            
            // Indicadores de opciones
            $table->boolean('tiene_laminado')->default(false)->after('cantidad_mayoreo');
            $table->string('material')->nullable()->after('tiene_laminado');
            
            // Campos adicionales
            $table->integer('orden')->default(0)->after('material');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn([
                'precio_laminado',
                'medida',
                'precio_mayoreo',
                'precio_mayoreo_laminado',
                'cantidad_mayoreo',
                'tiene_laminado',
                'material',
                'orden',
            ]);
        });
    }
};
