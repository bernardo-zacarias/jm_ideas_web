<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminUserSeeder::class, // Crear usuario administrador
            UserSeeder::class, // Crear otros usuarios
            CategoriaSeeder::class, // Crear categorías de productos
            ProductoSeeder::class, // Crear productos de prueba
        ]);
    }
}
