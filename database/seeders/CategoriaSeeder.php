<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Imanes y Recuerdos',
                'descripcion' => 'Imanes personalizados en diversos tamaños y estilos',
            ],
            [
                'nombre' => 'Fotografía y Formatos Especiales',
                'descripcion' => 'Impresión en papel fotográfico de alta calidad',
            ],
            [
                'nombre' => 'Papelería, Volantes y Tarjetas',
                'descripcion' => 'Volantes, tarjetas de presentación y papelería corporativa',
            ],
            [
                'nombre' => 'Llaveros y Artículos Sublimables',
                'descripcion' => 'Llaveros en diversos materiales y opciones sublimables',
            ],
            [
                'nombre' => 'Chapitas Personalizadas',
                'descripcion' => 'Chapitas y pins personalizados para eventos y regalos',
            ],
            [
                'nombre' => 'Cerámicas',
                'descripcion' => 'Cerámicas personalizadas en múltiples tamaños',
            ],
            [
                'nombre' => 'Tazones',
                'descripcion' => 'Tazones cerámicos con diseños personalizados',
            ],
            [
                'nombre' => 'Poleras',
                'descripcion' => 'Camisetas personalizadas en algodón y poliéster',
            ],
            [
                'nombre' => 'Delantales, Jockey, Cojines y Morrales',
                'descripcion' => 'Artículos de tela personalizados para eventos y regalos',
            ],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(
                ['nombre' => $categoria['nombre']],
                ['descripcion' => $categoria['descripcion']]
            );
        }
    }
}
