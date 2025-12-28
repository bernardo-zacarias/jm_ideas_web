<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\ItemPedido;

class PedidoController extends Controller
{
    /**
     * Muestra el estado de un pedido guest (sin autenticación)
     */
    public function showPublic(Pedido $pedido)
    {
        // Solo permitir acceso a pedidos sin usuario_id (guest)
        if ($pedido->usuario_id !== null) {
            abort(403, 'Este pedido requiere autenticación para consultarlo.');
        }

        // Cargar los detalles del pedido
        $items = $pedido->items()->with(['cotizacion.producto', 'producto'])->get();

        // Retornar vista de confirmación (nuevo diseño)
        return view('pedidos.show', compact('pedido', 'items'));
    }
}