<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Cotizacion;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dashboard del administrador - vista general
     */
    public function dashboard()
    {
        $totalProductos = Producto::count();
        $totalCategorias = Categoria::count();
        $totalPedidos = Pedido::count();
        $totalCotizaciones = Cotizacion::count();
        
        // Últimos pedidos recientes
        $pedidosRecientes = Pedido::latest()->take(5)->get();
        
        // Cotizaciones pendientes
        $cotizacionesPendientes = Cotizacion::where('estado', 'pendiente')->count();

        return view('admin.dashboard', compact(
            'totalProductos',
            'totalCategorias',
            'totalPedidos',
            'totalCotizaciones',
            'pedidosRecientes',
            'cotizacionesPendientes'
        ));
    }

    // ========== CATEGORÍAS ==========

    /**
     * Listar todas las categorías
     */
    public function indexCategorias()
    {
        $categorias = Categoria::withCount('productos')->paginate(10);
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Crear nueva categoría
     */
    public function createCategoria()
    {
        return view('admin.categorias.create');
    }

    /**
     * Guardar nueva categoría
     */
    public function storeCategoria(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'descripcion' => 'nullable|string',
        ]);

        Categoria::create($validated);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada exitosamente');
    }

    /**
     * Editar categoría
     */
    public function editCategoria(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Actualizar categoría
     */
    public function updateCategoria(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
            'descripcion' => 'nullable|string',
        ]);

        $categoria->update($validated);

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada exitosamente');
    }

    /**
     * Eliminar categoría
     */
    public function destroyCategoria(Categoria $categoria)
    {
        // Verificar que no tenga productos asociados
        if ($categoria->productos()->count() > 0) {
            return redirect()->route('admin.categorias.index')->with('error', 'No puedes eliminar una categoría que tiene productos asociados');
        }

        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('success', 'Categoría eliminada exitosamente');
    }

    // ========== PRODUCTOS ==========

    /**
     * Listar todos los productos
     */
    public function indexProductos()
    {
        $productos = Producto::with('categoria')->paginate(10);
        return view('admin.productos.index', compact('productos'));
    }

    /**
     * Crear nuevo producto
     */
    public function createProducto()
    {
        $categorias = Categoria::all();
        return view('admin.productos.create', compact('categorias'));
    }

    /**
     * Guardar nuevo producto
     */
    public function storeProducto(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Manejo de imagen
        if ($request->hasFile('imagen')) {
            $categoria = Categoria::find($validated['categoria_id']);
            // Extraer nombre de la categoría (antes de la coma si existe)
            $nombreCategoria = trim(explode(',', $categoria->nombre)[0]);
            $carpetaCategoria = strtolower(str_replace([' ', 'y'], ['-', ''], $nombreCategoria));
            
            // Crear directorio si no existe
            $dirPath = public_path('images/productos/' . $carpetaCategoria);
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0755, true);
            }
            
            // Guardar archivo
            $archivo = $request->file('imagen');
            $nombreArchivo = time() . '_' . uniqid() . '.' . $archivo->getClientOriginalExtension();
            $archivo->move($dirPath, $nombreArchivo);
            
            $validated['imagen'] = $carpetaCategoria . '/' . $nombreArchivo;
        }

        Producto::create($validated);

        return redirect()->route('admin.productos.index')->with('success', 'Producto creado exitosamente');
    }

    /**
     * Editar producto
     */
    public function editProducto(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualizar producto
     */
    public function updateProducto(Request $request, Producto $producto)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Manejo de imagen
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen) {
                $rutaAntigua = public_path('images/productos/' . $producto->imagen);
                if (file_exists($rutaAntigua)) {
                    unlink($rutaAntigua);
                }
            }
            
            $categoria = Categoria::find($validated['categoria_id']);
            // Extraer nombre de la categoría (antes de la coma si existe)
            $nombreCategoria = trim(explode(',', $categoria->nombre)[0]);
            $carpetaCategoria = strtolower(str_replace([' ', 'y'], ['-', ''], $nombreCategoria));
            
            // Crear directorio si no existe
            $dirPath = public_path('images/productos/' . $carpetaCategoria);
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0755, true);
            }
            
            // Guardar archivo
            $archivo = $request->file('imagen');
            $nombreArchivo = time() . '_' . uniqid() . '.' . $archivo->getClientOriginalExtension();
            $archivo->move($dirPath, $nombreArchivo);
            
            $validated['imagen'] = $carpetaCategoria . '/' . $nombreArchivo;
        }

        $producto->update($validated);

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Eliminar producto
     */
    public function destroyProducto(Producto $producto)
    {
        // Eliminar imagen si existe
        if ($producto->imagen) {
            \Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado exitosamente');
    }

    // ========== COTIZACIONES ==========

    /**
     * Listar todas las cotizaciones
     */
    public function indexCotizaciones()
    {
        $cotizaciones = Cotizacion::with('usuario')->latest()->paginate(10);
        return view('admin.cotizaciones.index', compact('cotizaciones'));
    }

    /**
     * Ver detalles de cotización
     */
    public function showCotizacion(Cotizacion $cotizacion)
    {
        return view('admin.cotizaciones.show', compact('cotizacion'));
    }

    /**
     * Cambiar estado de cotización
     */
    public function updateEstadoCotizacion(Request $request, Cotizacion $cotizacion)
    {
        $validated = $request->validate([
            'estado' => 'required|in:pendiente,revisado,aprobado,rechazado',
        ]);

        $cotizacion->update($validated);

        return redirect()->route('admin.cotizaciones.show', $cotizacion)->with('success', 'Estado de cotización actualizado');
    }

    /**
     * Eliminar cotización
     */
    public function destroyCotizacion(Cotizacion $cotizacion)
    {
        $cotizacion->delete();
        return redirect()->route('admin.cotizaciones.index')->with('success', 'Cotización eliminada exitosamente');
    }

    // ========== PEDIDOS ==========

    /**
     * Listar todos los pedidos con filtros
     */
    public function indexPedidos(Request $request)
    {
        $query = Pedido::with('usuario');

        // Filtrar por estado
        if ($request->has('estado') && $request->estado !== '') {
            $query->where('estado', $request->estado);
        }

        // Filtrar y ordenar por fecha
        if ($request->has('fecha') && $request->fecha !== '') {
            if ($request->fecha === 'asc') {
                $query->oldest('created_at');
            } elseif ($request->fecha === 'desc') {
                $query->latest('created_at');
            }
        } else {
            // Por defecto, ordenar por fecha descendente (más nuevos primero)
            $query->latest('created_at');
        }

        $pedidos = $query->paginate(10);
        $estadoActual = $request->estado ?? '';
        $fechaActual = $request->fecha ?? 'desc';

        return view('admin.pedidos.index', compact('pedidos', 'estadoActual', 'fechaActual'));
    }

    /**
     * Ver detalles de pedido
     */
    public function showPedido(Pedido $pedido)
    {
        $items = $pedido->items()->get(); // Relación a items del pedido
        return view('admin.pedidos.show', compact('pedido', 'items'));
    }

    /**
     * Cambiar estado de pedido
     */
    public function updateEstadoPedido(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
            'estado' => 'required|in:pendiente,procesando,enviado,entregado,cancelado',
        ]);

        $pedido->update($validated);

        return redirect()->route('admin.pedidos.show', $pedido)->with('success', 'Estado de pedido actualizado');
    }

    /**
     * Eliminar pedido
     */
    public function destroyPedido(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('admin.pedidos.index')->with('success', 'Pedido eliminado exitosamente');
    }
}
