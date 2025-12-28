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
        // Verificar si la tabla existe y si los campos no existen
        if (Schema::hasTable('pedidos')) {
            Schema::table('pedidos', function (Blueprint $table) {
                // Agregar campos solo si no existen
                if (!Schema::hasColumn('pedidos', 'nombre_cliente')) {
                    $table->string('nombre_cliente')->nullable();
                }
                if (!Schema::hasColumn('pedidos', 'email_cliente')) {
                    $table->string('email_cliente')->nullable();
                }
                if (!Schema::hasColumn('pedidos', 'telefono_cliente')) {
                    $table->string('telefono_cliente')->nullable();
                }
                if (!Schema::hasColumn('pedidos', 'direccion_cliente')) {
                    $table->string('direccion_cliente')->nullable();
                }
                if (!Schema::hasColumn('pedidos', 'comuna_cliente')) {
                    $table->string('comuna_cliente')->nullable();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            if (Schema::hasColumn('pedidos', 'nombre_cliente')) {
                $table->dropColumn('nombre_cliente');
            }
            if (Schema::hasColumn('pedidos', 'email_cliente')) {
                $table->dropColumn('email_cliente');
            }
            if (Schema::hasColumn('pedidos', 'telefono_cliente')) {
                $table->dropColumn('telefono_cliente');
            }
            if (Schema::hasColumn('pedidos', 'direccion_cliente')) {
                $table->dropColumn('direccion_cliente');
            }
            if (Schema::hasColumn('pedidos', 'comuna_cliente')) {
                $table->dropColumn('comuna_cliente');
            }
        });
    }
};
