<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\ItemPedido;

class CheckoutController extends Controller
{
    /**
     * Constructor sin middleware para permitir acceso público
     */
    public function __construct()
    {
        // No aplicar middleware aquí, lo hacemos por ruta
    }

    /**
     * Vista de checkout público (sin autenticación requerida)
     */
    public function indexPublic()
    {
        // Obtener carrito de sesión para invitados
        $items = session('guest_carrito', []);
        
        if (empty($items)) {
            \Log::warning("Intento de acceso a checkout vacío. Sesión: " . json_encode(session()->all()));
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        // Calcular total correctamente
        $total = 0;
        foreach ($items as $item) {
            $total += floatval($item['costo_final'] ?? 0);
        }

        \Log::info("Checkout público: " . count($items) . " items, Total: $total");

        // Pasar datos a la vista para que el usuario complete sus datos
        return view('checkout.guest', compact('items', 'total'));
    }

    /**
     * Crear pedido para usuario no registrado (GUEST CHECKOUT)
     */
    public function storeGuest(Request $request)
    {
        // Validar datos del cliente
        $validated = $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'email_cliente' => 'required|email|max:255',
            'telefono_cliente' => 'required|string|max:20',
            'direccion_cliente' => 'required|string|max:255',
            'comuna_cliente' => 'required|string|max:100',
            'carrito_items' => 'required',
            'total' => 'required|numeric|min:0.01',
        ], [
            'nombre_cliente.required' => 'El nombre es obligatorio',
            'email_cliente.required' => 'El email es obligatorio',
            'email_cliente.email' => 'Ingresa un email válido',
            'telefono_cliente.required' => 'El teléfono es obligatorio',
            'direccion_cliente.required' => 'La dirección es obligatoria',
            'comuna_cliente.required' => 'La comuna es obligatoria',
            'carrito_items.required' => 'El carrito está vacío',
            'total.required' => 'El total es requerido',
        ]);

        DB::beginTransaction();

        try {
            // Decodificar items del carrito
            $carritoItems = is_string($validated['carrito_items']) 
                ? json_decode($validated['carrito_items'], true) 
                : $validated['carrito_items'];

            if (empty($carritoItems)) {
                DB::rollBack();
                return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
            }

            // Crear pedido SIN usuario_id (guest checkout)
            $pedido = Pedido::create([
                'usuario_id' => null, // No hay usuario registrado
                'estado' => 'pendiente_pago',
                'total' => (float)$validated['total'],
                'metodo_pago' => null,
                // Guardar datos del cliente
                'nombre_cliente' => $validated['nombre_cliente'],
                'email_cliente' => $validated['email_cliente'],
                'telefono_cliente' => $validated['telefono_cliente'],
                'direccion_cliente' => $validated['direccion_cliente'],
                'comuna_cliente' => $validated['comuna_cliente'],
            ]);

            // Crear items del pedido desde los datos del carrito
            foreach ($carritoItems as $item) {
                ItemPedido::create([
                    'pedido_id' => $pedido->id,
                    'cotizacion_id' => $item['cotizacion_id'] ?? null,
                    'producto_id' => $item['producto_id'] ?? null,
                    'producto_nombre' => $item['producto_nombre'] ?? 'Producto',
                    'cantidad' => (int)($item['cantidad'] ?? 1),
                    'costo_final' => (float)($item['costo_final'] ?? 0),
                    'ancho' => $item['ancho'] ?? null,
                    'alto' => $item['alto'] ?? null,
                    'requiere_diseno' => (bool)($item['requiere_diseno'] ?? false),
                    'ruta_archivo' => $item['ruta_archivo'] ?? null,
                    'design_data' => $item['design_data'] ?? null,
                ]);
            }

            DB::commit();

            // Limpiar sesión del carrito
            session()->forget('guest_carrito');

            \Log::info("Pedido guest creado: ID={$pedido->id}, Total={$pedido->total}, Cliente={$pedido->nombre_cliente}");

            // Redirigir a pago
            return redirect()->route('transbank.iniciar', $pedido->id)
                           ->with('success', 'Pedido creado. Por favor completa el pago.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error("Error en Guest Checkout: " . $e->getMessage() . " | Trace: " . $e->getTraceAsString());
            return back()->with('error', 'Error al procesar tu pedido: ' . $e->getMessage());
        }
    }
}