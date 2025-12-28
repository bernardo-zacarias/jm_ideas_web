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
        Schema::table('pedidos', function (Blueprint $table) {
            // Campos para compras de clientes no registrados (guest checkout)
            $table->string('nombre_cliente')->nullable()->after('usuario_id');
            $table->string('email_cliente')->nullable()->after('nombre_cliente');
            $table->string('telefono_cliente')->nullable()->after('email_cliente');
            $table->string('direccion_cliente')->nullable()->after('telefono_cliente');
            $table->string('comuna_cliente')->nullable()->after('direccion_cliente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn([
                'nombre_cliente',
                'email_cliente',
                'telefono_cliente',
                'direccion_cliente',
                'comuna_cliente',
            ]);
        });
    }
};
