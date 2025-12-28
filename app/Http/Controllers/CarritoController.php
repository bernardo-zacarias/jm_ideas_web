<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // ¡Necesario para guardar archivos!
use App\Models\Carrito;
use App\Models\ItemCarrito;
use App\Models\Cotizacion;
use App\Models\Producto;
use App\Http\Controllers\Controller; 

class CarritoController extends Controller
{
    const COSTO_DISENO = 10000;

    /**
     * Sin middleware de auth: permite acceso público con soporte para invitados
     */
    public function __construct()
    {
        // Auth es opcional - soporta tanto usuarios como invitados
    }

    /**
     * Obtiene o crea carrito para usuario autenticado
     * Para invitados, usa carrito de sesión
     */
    protected function getOrCreateActiveCart()
    {
        // Si está autenticado, usa la BD
        if (Auth::check()) {
            return Carrito::firstOrCreate(
                ['usuario_id' => Auth::id(), 'estado' => 'activo'],
                ['usuario_id' => Auth::id(), 'estado' => 'activo']
            );
        }

        // Para invitados, retorna null - manejaremos con sesión
        return null;
    }

    /**
     * Obtiene carrito de sesión para invitados
     */
    protected function getSessionCart()
    {
        return session()->get('guest_carrito', []);
    }

    /**
     * Guarda carrito de sesión para invitados
     */
    protected function saveSessionCart($items)
    {
        session()->put('guest_carrito', $items);
    }

    public function index()
    {
        // Si está autenticado, obtiene carrito de BD
        if (Auth::check()) {
            $carrito = $this->getOrCreateActiveCart();
            $items = $carrito->items()->with('cotizacion.producto')->get();
            $total = $items->sum('costo_final');
        } else {
            // Para invitados, obtiene carrito de sesión (mantiene como arrays)
            $carrito = null;
            $sessionCart = $this->getSessionCart();
            $items = collect($sessionCart); // Mantiene como arrays, no convierte a objetos
            $total = array_sum(array_column($sessionCart, 'costo_final'));
        }

        return view('carrito.carrito', compact('carrito', 'items', 'total'));
    }

    /**
     * Agrega un ítem al carrito, manejando datos del Catálogo, Cotizador, y Archivo.
     * Soporta tanto usuarios autenticados como invitados.
     */
    public function store(Request $request)
    {
        $isFromCatalogo = $request->filled('producto_id') && $request->has('opcion_archivo');
        
        // 1. Lógica de Validación Inteligente (Validación Condicional)
        $rules = [
            'cotizacion_id' => 'required|numeric', 
            'cantidad' => 'required|integer|min:1',
            'opcion_archivo' => 'nullable|in:subir,diseno', 
            'requiere_diseno' => 'nullable|boolean',
            
            // Reglas de IDs condicionales
            'producto_id' => $isFromCatalogo ? 'required|exists:productos,id' : 'nullable|numeric', 
            'cotizacion_id' => $isFromCatalogo ? 'nullable|numeric' : 'required|exists:cotizaciones,id',
            
            // Medidas/Costo Final son requeridos SOLO por el Cotizador
            'ancho' => $isFromCatalogo ? 'nullable|numeric' : 'required|numeric|min:0.01',
            'alto' => $isFromCatalogo ? 'nullable|numeric' : 'required|numeric|min:0.01',
            'costo_final' => $isFromCatalogo ? 'nullable|numeric' : 'required|numeric|min:0',
            
            // 🚨 VALIDACIÓN DEL ARCHIVO
            'archivo_diseno' => ['nullable', 'file', 'mimes:jpeg,png,pdf,ai,psd,zip', 'max:10240'], // Max 10MB
        ];

        $validated = $request->validate($rules);
        
        // 2. Inicialización, CÁLCULO y ASIGNACIÓN
        $ancho = $validated['ancho'] ?? 0;
        $alto = $validated['alto'] ?? 0;
        $subtotalCalculado = 0;
        $requiereDiseno = false;
        
        $finalProductoId = $validated['producto_id'] ?? null;
        $finalCotizacionId = $validated['cotizacion_id'] ?? null;
        $rutaArchivo = null;

        // 3. LÓGICA DE CÁLCULO
        if (!$isFromCatalogo) {
            // A. FLUJO DE COTIZADOR
            $cotizacionBase = Cotizacion::find($finalCotizacionId);
            if (!$cotizacionBase) { return back()->with('error', 'Cotización base no encontrada.'); }

            $subtotalCalculado = $validated['costo_final'];
            $requiereDiseno = (bool)($validated['requiere_diseno'] ?? false);
            
        } else {
            // B. FLUJO DE CATÁLOGO
            $producto = Producto::find($finalProductoId);
            if (!$producto) { return back()->with('error', 'Producto de Catálogo no encontrado.'); }
            
            $requiereDiseno = ($validated['opcion_archivo'] === 'diseno');
            $costoDiseno = $requiereDiseno ? self::COSTO_DISENO : 0;
            $subtotalCalculado = ($producto->precio * $validated['cantidad']) + $costoDiseno;
            $ancho = $alto = 0;
            
            $cotizacionBase = Cotizacion::where('producto_id', $finalProductoId)->first();
            $finalCotizacionId = $cotizacionBase->id ?? null;
        }

        // 4. GUARDAR ARCHIVO
        if ($request->hasFile('archivo_diseno')) {
            $rutaArchivo = $request->file('archivo_diseno')->store('disenos_clientes', 'public');
        }

        // 5. Obtener nombre del producto para mostrar en carrito
        $nombreProducto = 'Producto';
        $imagenProducto = null;
        if ($finalProductoId) {
            $prod = Producto::find($finalProductoId);
            $nombreProducto = $prod->nombre ?? 'Producto';
            $imagenProducto = $prod->imagen ?? null;
        } elseif ($finalCotizacionId) {
            $cot = Cotizacion::find($finalCotizacionId);
            if ($cot && $cot->producto) {
                $nombreProducto = $cot->producto->nombre ?? 'Producto Cotizado';
                $imagenProducto = $cot->producto->imagen ?? null;
            }
        }

        // 6. Crear ítem y guardar en BD o sesión
        $itemData = [
            'producto_nombre' => $nombreProducto,
            'producto_imagen' => $imagenProducto,
            'cotizacion_id' => $finalCotizacionId, 
            'producto_id' => $finalProductoId, 
            'ancho' => $ancho, 
            'alto' => $alto,  
            'cantidad' => $validated['cantidad'],
            'costo_final' => $subtotalCalculado,
            'requiere_diseno' => $requiereDiseno,
            'ruta_archivo' => $rutaArchivo,
            'design_data' => $request->input('design_data', null), // Incluir datos del diseño personalizado
        ];

        // Si está autenticado, guarda en BD
        if (Auth::check()) {
            $carrito = $this->getOrCreateActiveCart();
            ItemCarrito::create([
                'carrito_id' => $carrito->id,
                ...$itemData
            ]);
        } else {
            // Para invitados, guarda en sesión
            $sessionCart = $this->getSessionCart();
            $itemData['id'] = uniqid('guest_', true); // ID único para sesión
            $sessionCart[] = $itemData;
            $this->saveSessionCart($sessionCart);
        }

        return redirect()->route('carrito.index')->with('success', 'Ítem añadido al carrito.');
    }

    public function destroy($itemId = null)
    {
        // Para usuarios autenticados
        if (Auth::check()) {
            $item = ItemCarrito::findOrFail($itemId);
            if ($item->carrito->usuario_id !== Auth::id() || $item->carrito->estado !== 'activo') {
                return back()->with('error', 'El ítem no pertenece a tu carrito activo.');
            }
            $item->delete();
            return back()->with('success', 'Ítem eliminado del carrito.');
        }
        
        // Para invitados, elimina de sesión
        $sessionCart = $this->getSessionCart();
        $sessionCart = array_filter($sessionCart, fn($item) => $item['id'] !== $itemId);
        $this->saveSessionCart(array_values($sessionCart));
        
        return back()->with('success', 'Ítem eliminado del carrito.');
    }
}