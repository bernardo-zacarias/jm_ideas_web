<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Cotizacion;
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

    /**
     * Guarda una cotización del diseñador de tazas en la base de datos.
     */
    public function saveCotizacion(Request $request)
    {
        // Validar los datos requeridos
        $validated = $request->validate([
            'tipo_producto' => 'required|string',
            'imagen_diseño' => 'nullable|string',
            'color_producto' => 'required|string',
            'descripcion' => 'required|string',
            'notas' => 'nullable|string',
        ]);

        try {
            // Crear la cotización en la base de datos
            $cotizacion = Cotizacion::create([
                'tipo_producto' => $validated['tipo_producto'],
                'imagen_diseño' => $validated['imagen_diseño'],
                'color_producto' => $validated['color_producto'],
                'descripcion' => $validated['descripcion'],
                'notas' => $validated['notas'],
                'usuario_id' => auth()->id(), // NULL si es visitante
                'estado' => 'pendiente', // Estado inicial
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Cotización guardada exitosamente',
                'cotizacion_id' => $cotizacion->id,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la cotización: ' . $e->getMessage(),
            ], 500);
        }
    }
}