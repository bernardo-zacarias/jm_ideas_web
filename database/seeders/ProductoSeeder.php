<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener categorías
        $categoriaImanes = Categoria::where('nombre', 'Imanes y Recuerdos')->first();
        $categoriaFotografia = Categoria::where('nombre', 'Fotografía y Formatos Especiales')->first();
        $categoriaPapeleria = Categoria::where('nombre', 'Papelería, Volantes y Tarjetas')->first();
        $categoriaLlaveros = Categoria::where('nombre', 'Llaveros y Artículos Sublimables')->first();
        $categoriaChapitas = Categoria::where('nombre', 'Chapitas Personalizadas')->first();
        $categoriaCeramicas = Categoria::where('nombre', 'Cerámicas')->first();
        $categoriaTazones = Categoria::where('nombre', 'Tazones')->first();
        $categoriaPoleras = Categoria::where('nombre', 'Poleras')->first();
        $categoriaDelantales = Categoria::where('nombre', 'Delantales, Jockey, Cojines y Morrales')->first();

        // PRODUCTOS: Imanes y Recuerdos
        if ($categoriaImanes) {
            $productosImanes = [
                ['nombre' => 'Mini calendario con imán', 'descripcion' => 'Pequeño calendario con imán adhesivo', 'precio' => 300, 'medida' => 'Estándar'],
                ['nombre' => 'Imán recuerdo', 'descripcion' => 'Imán personalizado pequeño', 'precio' => 200, 'medida' => '5×7 cm'],
                ['nombre' => 'Imán recuerdo mediano', 'descripcion' => 'Imán personalizado mediano', 'precio' => 300, 'medida' => '5.5×8.5 cm'],
                ['nombre' => 'Imán 9×13 cm', 'descripcion' => 'Imán personalizado de 9×13 cm', 'precio' => 800, 'medida' => '9×13 cm'],
                ['nombre' => 'Imán 10×15 cm', 'descripcion' => 'Imán personalizado de 10×15 cm', 'precio' => 1000, 'medida' => '10×15 cm'],
                ['nombre' => 'Imán 13×18 cm', 'descripcion' => 'Imán personalizado de 13×18 cm', 'precio' => 1400, 'medida' => '13×18 cm'],
                ['nombre' => 'Imán 15×20 cm', 'descripcion' => 'Imán personalizado de 15×20 cm', 'precio' => 1800, 'medida' => '15×20 cm'],
                ['nombre' => 'Imán A4 20×30 cm', 'descripcion' => 'Imán personalizado tamaño A4 (20×30 cm)', 'precio' => 2500, 'medida' => '20×30 cm'],
                ['nombre' => 'Mini imán boliche con foto', 'descripcion' => 'Imán boliche miniatura con foto', 'precio' => 7500, 'medida' => 'Estándar'],
                ['nombre' => 'Imán tres usos 2×7', 'descripcion' => 'Imán multiusos personalizado', 'precio' => 200, 'medida' => '2×7 cm'],
                ['nombre' => 'Imán tres usos 5.5×8.5', 'descripcion' => 'Imán multiusos personalizado', 'precio' => 900, 'medida' => '5.5×8.5 cm'],
                ['nombre' => 'Imán boliche con foto', 'descripcion' => 'Imán boliche personalizado con foto', 'precio' => 15000, 'medida' => 'Estándar'],
                ['nombre' => 'Imán texto personalizado', 'descripcion' => 'Imán con texto personalizado', 'precio' => 1900, 'medida' => 'Personalizado'],
                ['nombre' => 'Imán texto 5×4', 'descripcion' => 'Imán con texto 5×4 cm', 'precio' => 1700, 'medida' => '5×4 cm'],
                ['nombre' => 'Imán 9×6 cm', 'descripcion' => 'Imán personalizado de 9×6 cm', 'precio' => 1800, 'medida' => '9×6 cm'],
                ['nombre' => 'Imán 7×5×10', 'descripcion' => 'Imán personalizado 7×5×10', 'precio' => 2500, 'medida' => '7×5×10'],
            ];
            foreach ($productosImanes as $p) {
                Producto::updateOrCreate(['nombre' => $p['nombre']], array_merge($p, ['categoria_id' => $categoriaImanes->id]));
            }
        }

        // PRODUCTOS: Fotografía
        if ($categoriaFotografia) {
            $productosFotografia = [
                ['nombre' => 'Fotos tipo polaroid', 'descripcion' => 'Fotos en formato polaroid de alta calidad', 'precio' => 300, 'medida' => '10×8 cm'],
                ['nombre' => 'Fotos estándar 9×13', 'descripcion' => 'Fotos en papel fotográfico alta calidad', 'precio' => 500, 'medida' => '9×13 cm'],
                ['nombre' => 'Fotos estándar 10×15', 'descripcion' => 'Fotos en papel fotográfico alta calidad', 'precio' => 500, 'medida' => '10×15 cm'],
                ['nombre' => 'Fotos estándar 13×18', 'descripcion' => 'Fotos en papel fotográfico alta calidad', 'precio' => 500, 'medida' => '13×18 cm'],
                ['nombre' => 'Foto 15×21 cm', 'descripcion' => 'Foto en papel fotográfico alta calidad', 'precio' => 900, 'medida' => '15×21 cm'],
                ['nombre' => 'Foto A4 20×30', 'descripcion' => 'Foto tamaño A4 en papel fotográfico', 'precio' => 1500, 'medida' => '20×30 cm'],
                ['nombre' => 'Foto A3 30×40', 'descripcion' => 'Foto tamaño A3 en papel fotográfico', 'precio' => 3500, 'medida' => '30×40 cm'],
                ['nombre' => 'Fotos Carnet Pack', 'descripcion' => 'Pack de 6 fotos tipo carnet', 'precio' => 1000, 'medida' => 'Pack 6 un'],
                ['nombre' => 'Tarjeta plegable 9 fotos', 'descripcion' => 'Tarjeta plegable con 9 fotos', 'precio' => 3000, 'medida' => '9 fotos'],
                ['nombre' => 'Marco goma eva', 'descripcion' => 'Marco de goma eva con fotos incluidas', 'precio' => 3000, 'medida' => 'Incluye fotos'],
            ];
            foreach ($productosFotografia as $p) {
                Producto::updateOrCreate(['nombre' => $p['nombre']], array_merge($p, ['categoria_id' => $categoriaFotografia->id]));
            }
        }

        // PRODUCTOS: Papelería
        if ($categoriaPapeleria) {
            $productosPapeleria = [
                ['nombre' => 'Volante 9×11 cm', 'descripcion' => 'Volante en papel blanco 75 grs', 'precio' => 15, 'medida' => '9×11 cm'],
                ['nombre' => 'Volante 10×14 cm', 'descripcion' => 'Volante en papel blanco 75 grs', 'precio' => 20, 'medida' => '10×14 cm'],
                ['nombre' => 'Volante 13×18 cm', 'descripcion' => 'Volante en papel blanco 75 grs', 'precio' => 30, 'medida' => '13×18 cm'],
                ['nombre' => 'Papel Fotográfico 10×14', 'descripcion' => 'Papel fotográfico 115 grs (x100)', 'precio' => 5000, 'medida' => '10×14 cm'],
                ['nombre' => 'Papel Fotográfico 13×18', 'descripcion' => 'Papel fotográfico 115 grs (x100)', 'precio' => 10000, 'medida' => '13×18 cm'],
                ['nombre' => 'Tarjetas Presentación Matte', 'descripcion' => 'Tarjetas en papel matte (100 un)', 'precio' => 6000, 'medida' => '100 un'],
                ['nombre' => 'Tarjetas Presentación Brillante', 'descripcion' => 'Tarjetas en papel brillante (100 un)', 'precio' => 7000, 'medida' => '100 un'],
                ['nombre' => 'Sobres Impresos', 'descripcion' => 'Sobres personalizados (100 un)', 'precio' => 7000, 'medida' => '100 un'],
            ];
            foreach ($productosPapeleria as $p) {
                Producto::updateOrCreate(['nombre' => $p['nombre']], array_merge($p, ['categoria_id' => $categoriaPapeleria->id]));
            }
        }

        // PRODUCTOS: Llaveros
        if ($categoriaLlaveros) {
            $productosLlaveros = [
                ['nombre' => 'Llavero Plastificado Mini', 'descripcion' => 'Llavero mini plastificado personalizado', 'precio' => 350, 'medida' => 'Mini'],
                ['nombre' => 'Llavero Plastificado 5×8', 'descripcion' => 'Llavero plastificado personalizado', 'precio' => 450, 'medida' => '5×8 cm'],
                ['nombre' => 'Llavero Acrílico', 'descripcion' => 'Llavero acrílico personalizado', 'precio' => 1000, 'medida' => 'Estándar'],
                ['nombre' => 'Llavero Metálico Sublimable', 'descripcion' => 'Llavero metálico sublimable (con caja)', 'precio' => 2500, 'medida' => 'Estándar'],
                ['nombre' => 'Llavero Metálico Corazón', 'descripcion' => 'Llavero metálico corazón (con caja)', 'precio' => 3000, 'medida' => 'Corazón'],
                ['nombre' => 'Placa MDF Huesito', 'descripcion' => 'Placa MDF huesito sublimable', 'precio' => 3000, 'medida' => 'Huesito'],
            ];
            foreach ($productosLlaveros as $p) {
                Producto::updateOrCreate(['nombre' => $p['nombre']], array_merge($p, ['categoria_id' => $categoriaLlaveros->id]));
            }
        }

        // PRODUCTOS: Chapitas
        if ($categoriaChapitas) {
            $productosChapitas = [
                ['nombre' => 'Chapita Pin 44 mm', 'descripcion' => 'Chapita pin personalizada 44 mm', 'precio' => 400, 'medida' => '44 mm'],
                ['nombre' => 'Chapita Pin 56 mm', 'descripcion' => 'Chapita pin personalizada 56 mm', 'precio' => 500, 'medida' => '56 mm'],
                ['nombre' => 'Chapita Espejo 56 mm', 'descripcion' => 'Chapita espejo personalizada 56 mm', 'precio' => 700, 'medida' => '56 mm Espejo'],
                ['nombre' => 'Chapita con Imán 56 mm', 'descripcion' => 'Chapita con imán personalizada 56 mm', 'precio' => 900, 'medida' => '56 mm Imán'],
            ];
            foreach ($productosChapitas as $p) {
                Producto::updateOrCreate(['nombre' => $p['nombre']], array_merge($p, ['categoria_id' => $categoriaChapitas->id]));
            }
        }

        // PRODUCTOS: Cerámicas
        if ($categoriaCeramicas) {
            $productosCeramicas = [
                ['nombre' => 'Cerámica 10×15', 'descripcion' => 'Cerámica personalizada 10×15', 'precio' => 3000, 'medida' => '10×15'],
                ['nombre' => 'Cerámica 15×15', 'descripcion' => 'Cerámica personalizada 15×15', 'precio' => 4000, 'medida' => '15×15'],
                ['nombre' => 'Cerámica 15×20', 'descripcion' => 'Cerámica personalizada 15×20', 'precio' => 5000, 'medida' => '15×20'],
                ['nombre' => 'Cerámica 20×30', 'descripcion' => 'Cerámica personalizada 20×30', 'precio' => 7000, 'medida' => '20×30'],
            ];
            foreach ($productosCeramicas as $p) {
                Producto::updateOrCreate(['nombre' => $p['nombre']], array_merge($p, ['categoria_id' => $categoriaCeramicas->id]));
            }
        }

        // PRODUCTOS: Tazones
        if ($categoriaTazones) {
            $productosTazones = [
                ['nombre' => 'Tazón 11 oz', 'descripcion' => 'Tazón cerámico 11 oz (con caja)', 'precio' => 3500, 'medida' => '11 oz'],
                ['nombre' => 'Tazón dos colores 11 oz', 'descripcion' => 'Tazón dos colores 11 oz (con caja)', 'precio' => 4500, 'medida' => '11 oz dos colores'],
                ['nombre' => 'Tazón mágico 11 oz', 'descripcion' => 'Tazón mágico 11 oz (con caja)', 'precio' => 6000, 'medida' => '11 oz mágico'],
            ];
            foreach ($productosTazones as $p) {
                Producto::updateOrCreate(['nombre' => $p['nombre']], array_merge($p, ['categoria_id' => $categoriaTazones->id]));
            }
        }

        // PRODUCTOS: Poleras
        if ($categoriaPoleras) {
            $productosPoleras = [
                ['nombre' => 'Polera Polyester', 'descripcion' => 'Polera poliéster con imagen', 'precio' => 5990, 'medida' => 'XS-S-M-L-XL-2XL'],
                ['nombre' => 'Polera Algodón Standard', 'descripcion' => 'Polera algodón personalizada', 'precio' => 7990, 'medida' => 'S-XS-M-L'],
                ['nombre' => 'Polera Algodón Premium', 'descripcion' => 'Polera algodón premium', 'precio' => 9990, 'medida' => 'XS-S-M-L'],
                ['nombre' => 'Polera Algodón Clásica', 'descripcion' => 'Polera algodón clásica', 'precio' => 9990, 'medida' => 'S-XS-M-L'],
                ['nombre' => 'Polera sin imagen', 'descripcion' => 'Polera básica sin imagen', 'precio' => 5990, 'medida' => 'S-M-L'],
                ['nombre' => 'Polera canguro', 'descripcion' => 'Polera canguro personalizada', 'precio' => 14990, 'medida' => 'XS-S-M-L'],
            ];
            foreach ($productosPoleras as $p) {
                Producto::updateOrCreate(['nombre' => $p['nombre']], array_merge($p, ['categoria_id' => $categoriaPoleras->id]));
            }
        }

        // PRODUCTOS: Delantales
        if ($categoriaDelantales) {
            $productosDelantales = [
                ['nombre' => 'Delantal BÁSICO', 'descripcion' => 'Delantal básico personalizado', 'precio' => 4500, 'medida' => 'Estándar'],
                ['nombre' => 'Delantal colores', 'descripcion' => 'Delantal en colores personalizado', 'precio' => 5500, 'medida' => 'Estándar'],
                ['nombre' => 'Morrales en colores', 'descripcion' => 'Morrales personalizados en colores', 'precio' => 3000, 'medida' => 'Estándar'],
                ['nombre' => 'Jockey', 'descripcion' => 'Jockey personalizado', 'precio' => 3990, 'medida' => 'Estándar'],
            ];
            foreach ($productosDelantales as $p) {
                Producto::updateOrCreate(['nombre' => $p['nombre']], array_merge($p, ['categoria_id' => $categoriaDelantales->id]));
            }
        }
    }
}
