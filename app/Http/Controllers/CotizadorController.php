<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\Cotizacion;
use App\Http\Controllers\Controller;

class CotizadorController extends Controller
{
    /**
     * Muestra el formulario de cotización al cliente
     */
    public function index()
    {
        // Cargar todas las cotizaciones disponibles (plantillas de precios)
        $productos = Cotizacion::all();
        
        $productosCotizables = collect();
        if ($productos->isNotEmpty()) {
            $productosCotizables = $productos->map(function ($cotizacion) {
                return [
                    'id' => $cotizacion->id,
                    'nombre' => $cotizacion->nombre,
                    'valor_base' => $cotizacion->valor,
                ];
            });
        }
        
        return view('cotizador.cotizador', compact('productosCotizables'));
    }

    /**
     * Procesa la solicitud de cotización
     */
    public function cotizar(Request $request)
    {
        // Validación SIN la regla exists que causa problemas
        $validatedData = $request->validate([
            'producto_id' => 'required|integer|min:1',
            'ancho' => 'required|numeric|min:0.01',
            'alto' => 'required|numeric|min:0.01',
            'cantidad' => 'required|integer|min:1',
            'costo_final' => 'required|numeric|min:0',
        ]);

        // Verificar producto manualmente
        $producto = Producto::find($validatedData['producto_id']);
        if (!$producto) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El producto seleccionado no existe.');
        }

        try {
            // Crear la cotización
            Cotizacion::create([
                'usuario_id' => Auth::id(),
                'producto_id' => $validatedData['producto_id'],
                'ancho' => $validatedData['ancho'],
                'alto' => $validatedData['alto'],
                'cantidad' => $validatedData['cantidad'],
                'estado' => 'pendiente',
                'nombre' => 'SOLICITUD-' . $producto->nombre . '-' . time(),
                'valor' => $validatedData['costo_final'],
            ]);

            return redirect()->route('cotizador.index')
                ->with('success', '¡Tu solicitud de cotización ha sido enviada con éxito! Un administrador la revisará pronto.');
        } catch (\Exception $e) {
            \Log::error('Error al crear cotización:', ['error' => $e->getMessage()]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al procesar tu solicitud. Intenta nuevamente.');
        }
    }
}
