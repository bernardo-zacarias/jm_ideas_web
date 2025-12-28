<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    /**
     * Muestra el listado de productos agrupados por categoría.
     */
    public function index(Request $request)
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();
        
        // Construir la query base
        $query = Producto::with('categoria');
        
        // Filtrar por categoría si se proporciona
        if ($request->has('category') && $request->get('category') != '') {
            $query->where('categoria_id', $request->get('category'));
        }
        
        // Paginar los resultados
        $productos = $query->paginate(6);

        return view('catalogo.index', compact('categorias', 'productos'));
    }

    /**
     * Busca productos por nombre o descripción.
     */
    public function buscar(Request $request)
    {
        $categorias = Categoria::all();
        $termino = $request->get('q', '');
        
        // Construir la query de búsqueda
        $query = Producto::with('categoria');
        
        if ($termino) {
            $query->where('nombre', 'like', "%{$termino}%")
                  ->orWhere('descripcion', 'like', "%{$termino}%");
        }
        
        // Paginar los resultados
        $productos = $query->paginate(6);
        
        return view('catalogo.index', compact('categorias', 'productos', 'termino'));
    }

    /**
     * Muestra los detalles de un producto individual.
     */
    public function show(Producto $producto)
    {
        return view('catalogo.show', compact('producto'));
    }
}