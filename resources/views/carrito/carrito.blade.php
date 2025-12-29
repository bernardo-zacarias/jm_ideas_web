@extends('layouts.app')

@section('title', 'Carrito de Compras - JM Ideas')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4">
    <div class="max-w-7xl mx-auto">
        
        <!-- Indicador de Progreso -->
        <div class="text-center mb-8">
            <h1 class="text-5xl font-bold text-gray-900 mb-3">Carrito de Compras</h1>
            <p class="text-lg text-gray-600 mb-6">Revisa tus productos antes de proceder al pago</p>
            
            <div class="flex items-center justify-center gap-8 mt-8">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-jm-orange text-white flex items-center justify-center font-bold shadow-lg">1</div>
                    <span class="text-sm font-semibold text-jm-orange">Revisar Carrito</span>
                </div>
                <div class="w-20 h-1 bg-gray-300 rounded"></div>
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold">2</div>
                    <span class="text-sm font-medium text-gray-500">Datos de Contacto</span>
                </div>
                <div class="w-20 h-1 bg-gray-300 rounded"></div>
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold">3</div>
                    <span class="text-sm font-medium text-gray-500">Pago</span>
                </div>
            </div>
        </div>

        <!-- Mensajes de Éxito/Error -->
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-6 shadow-sm animate-fade-in">
                <div class="flex items-start">
                    <i class="fa-solid fa-check-circle text-2xl mr-3 mt-1"></i>
                    <div class="flex-1">
                        <h3 class="font-bold mb-1">¡Éxito!</h3>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-6 shadow-sm">
                <div class="flex items-start">
                    <i class="fa-solid fa-exclamation-triangle text-2xl mr-3 mt-1"></i>
                    <div class="flex-1">
                        <h3 class="font-bold mb-1">¡Error!</h3>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
        
        @if ($items->isEmpty())
            <!-- Carrito Vacío -->
            <div class="bg-white rounded-2xl shadow-lg p-16 text-center border border-gray-200">
                <div class="max-w-md mx-auto">
                    <div class="w-32 h-32 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-shopping-cart text-gray-300 text-6xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Tu carrito está vacío</h2>
                    <p class="text-gray-600 mb-8 text-lg">¡Añade productos de nuestro catálogo o cotiza un trabajo personalizado!</p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('catalogo.index') }}" class="px-8 py-4 bg-gradient-to-r from-jm-orange to-orange-600 text-white font-bold rounded-xl hover:from-orange-600 hover:to-jm-orange transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <i class="fa-solid fa-store"></i>
                            Ir al Catálogo
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- Columna Izquierda: Listado de Ítems --}}
                <div class="lg:col-span-2 space-y-6">
                    @php $granTotal = 0; @endphp

                    @foreach ($items as $item)
                        @php
                            // Compatibilidad: $item puede ser objeto (BD) o array (sesión)
                            $isArray = is_array($item);
                            
                            $costo_final = $isArray ? ($item['costo_final'] ?? 0) : ($item->costo_final ?? 0);
                            $ancho = $isArray ? ($item['ancho'] ?? 0) : ($item->ancho ?? 0);
                            $alto = $isArray ? ($item['alto'] ?? 0) : ($item->alto ?? 0);
                            $cantidad = $isArray ? ($item['cantidad'] ?? 1) : ($item->cantidad ?? 1);
                            $requiere_diseno = $isArray ? ($item['requiere_diseno'] ?? false) : ($item->requiere_diseno ?? false);
                            $ruta_archivo = $isArray ? ($item['ruta_archivo'] ?? null) : ($item->ruta_archivo ?? null);
                            $producto_id = $isArray ? ($item['producto_id'] ?? null) : ($item->producto_id ?? null);
                            $cotizacion_id = $isArray ? ($item['cotizacion_id'] ?? null) : ($item->cotizacion_id ?? null);
                            $item_id = $isArray ? ($item['id'] ?? null) : ($item->id ?? null);
                            
                            $granTotal += $costo_final;
                            $esCotizado = $ancho > 0 || $alto > 0;
                            
                            // Determinar el nombre del producto y la categoría
                            $nombreProducto = $isArray && isset($item['producto_nombre']) ? $item['producto_nombre'] : 'Producto';
                            $nombreCategoria = 'Sin categoría';
                            $nombreItem = '';
                            
                            // Caso 1: Producto de catálogo (solo si es objeto con relaciones)
                            if ($producto_id && !$isArray && isset($item->producto) && $item->producto) {
                                $nombreProducto = $item->producto->nombre;
                                $nombreCategoria = isset($item->producto->categoria) && $item->producto->categoria ? $item->producto->categoria->nombre : 'Sin categoría';
                                $nombreItem = 'Producto de catálogo';
                            }
                            // Caso 2: Item de sesión (array) - usar el nombre que guardamos
                            elseif ($isArray && isset($item['producto_nombre'])) {
                                $nombreProducto = $item['producto_nombre'];
                                $nombreItem = 'Producto de Catálogo';
                            }
                            
                            $tipoOrigen = 'Compra de Catálogo';
                        @endphp
                        
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300">
                            <div class="flex flex-col md:flex-row p-6 gap-6">
                                
                                <!-- Imagen del Producto -->
                                <div class="flex-shrink-0">
                                    @php
                                        // Determinar la imagen a mostrar
                                        $imagenProducto = null;
                                        $tieneImagen = false;
                                        
                                        // Caso 0: Item de sesión (array) con imagen
                                        if ($isArray && isset($item['producto_imagen']) && $item['producto_imagen']) {
                                            $imagenRuta = $item['producto_imagen'];
                                            $imagenProducto = asset('images/productos/' . $imagenRuta);
                                            $tieneImagen = true;
                                        }
                                        // Caso 1: Producto de catálogo directo (objeto BD)
                                        elseif ($producto_id && !$isArray && isset($item->producto) && $item->producto) {
                                            if (isset($item->producto->imagen) && $item->producto->imagen) {
                                                $imagenRuta = $item->producto->imagen;
                                                $imagenProducto = asset('images/productos/' . $imagenRuta);
                                                $tieneImagen = true;
                                            }
                                        }
                                        
                                        // Obtener datos de diseño si existen
                                        $design_data = $isArray ? ($item['design_data'] ?? null) : ($item->design_data ?? null);
                                        $hasDesign = $design_data && $design_data !== '';
                                    @endphp
                                    
                                    <div class="flex flex-col gap-3">
                                        @if($tieneImagen && $imagenProducto)
                                            <div class="relative group w-full md:w-32">
                                                <img src="{{ $imagenProducto }}" 
                                                     alt="{{ $nombreProducto }}" 
                                                     class="w-full md:w-32 h-32 object-cover rounded-xl shadow-md group-hover:scale-105 transition-transform duration-300"
                                                     loading="lazy">
                                            </div>
                                        @else
                                            <div class="w-full md:w-32 h-32 bg-gradient-to-br from-jm-orange to-orange-600 rounded-xl shadow-md flex items-center justify-center group hover:scale-105 transition-transform duration-300">
                                                <i class="fa-solid fa-image text-white text-4xl"></i>
                                            </div>
                                        @endif
                                        
                                        <!-- Mostrar preview del diseño si existe -->
                                        @if($hasDesign)
                                            <div class="w-full md:w-32 relative group">
                                                <img id="designPreview{{ $item_id }}" 
                                                     src="" 
                                                     alt="Diseño personalizado" 
                                                     class="w-full md:w-32 h-32 object-contain rounded-xl shadow-md border-2 border-jm-orange bg-white p-1 group-hover:scale-105 transition-transform duration-300">
                                                <div class="absolute -top-2 -right-2 bg-jm-orange text-white w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold shadow-lg">
                                                    <i class="fa-solid fa-check"></i>
                                                </div>
                                            </div>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    try {
                                                        const designData = {!! json_encode($design_data) !!};
                                                        if (designData && designData.designImage) {
                                                            document.getElementById('designPreview{{ $item_id }}').src = designData.designImage;
                                                        }
                                                    } catch(e) {
                                                        console.log('Error al procesar diseño:', e);
                                                    }
                                                });
                                            </script>
                                        @endif
                                    </div>
                                </div>

                                <!-- Información del Producto -->
                                <div class="flex-grow">
                                    <div class="mb-3">
                                        <span class="inline-block px-3 py-1 bg-jm-orange/10 text-jm-orange rounded-full text-xs font-bold mb-2">
                                            {{ $tipoOrigen }}
                                        </span>
                                        <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $nombreProducto }}</h2>
                                        <div class="flex items-center gap-2 text-sm text-gray-600">
                                            <i class="fa-solid fa-tag text-jm-orange"></i>
                                            <span>{{ $nombreCategoria }}</span>
                                        </div>
                                        @if($nombreItem)
                                            <p class="text-xs text-gray-500 mt-1 italic">{{ $nombreItem }}</p>
                                        @endif
                                    </div>
                                    
                                    <!-- Indicador de Diseño Personalizado -->
                                    @if($hasDesign)
                                        <div class="mb-3 p-3 bg-gradient-to-r from-jm-orange/10 to-cyan-400/10 border-l-4 border-jm-orange rounded-lg">
                                            <div class="flex items-center gap-2 text-sm font-semibold text-jm-orange">
                                                <i class="fa-solid fa-check-circle"></i>
                                                <span>Diseño Personalizado Incluido</span>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- Detalles -->
                                    <div class="space-y-2 text-sm">
                                        <div class="flex items-center gap-2 text-gray-700">
                                            <i class="fa-solid fa-ruler-combined text-jm-orange"></i>
                                            @if ($esCotizado)
                                                <span><strong>Medidas:</strong> {{ $ancho }}m x {{ $alto }}m | <strong>Cantidad:</strong> {{ $cantidad }}</span>
                                            @else
                                                <span><strong>Cantidad:</strong> {{ $cantidad }}</span>
                                            @endif
                                        </div>
                                        
                                        <div class="flex items-center gap-2 {{ $requiere_diseno ? 'text-purple-600' : 'text-gray-500' }}">
                                            <i class="fa-solid fa-paintbrush"></i>
                                            <span>Diseño Gráfico: {{ $requiere_diseno ? 'Sí (+$10.000 incluido)' : 'No requerido' }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Precio y Acciones -->
                                <div class="flex md:flex-col justify-between md:justify-start items-end md:items-end text-right gap-4">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Total</p>
                                        <p class="text-3xl font-bold text-jm-orange">
                                            ${{ number_format($costo_final, 0, ',', '.') }}
                                        </p>
                                    </div>
                                    
                                    <form action="{{ route('carrito.destroy', ['item' => $item_id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="flex items-center gap-2 px-4 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all font-semibold border border-red-200" 
                                                onclick="return confirm('¿Estás seguro de eliminar este ítem del carrito?');">
                                            <i class="fa-solid fa-trash-alt"></i>
                                            <span class="hidden sm:inline">Eliminar</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                {{-- Columna Derecha: Resumen del Pedido --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200 sticky top-4">
                        <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                            <div class="w-10 h-10 rounded-full bg-jm-orange/10 flex items-center justify-center">
                                <i class="fa-solid fa-shopping-cart text-jm-orange text-lg"></i>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Resumen del Pedido</h2>
                        </div>

                        <!-- Subtotal -->
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-700 font-medium">Subtotal de Productos</span>
                                <span class="text-xl font-bold text-gray-900">${{ number_format($granTotal, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between items-center pb-4 border-b border-gray-200">
                                <span class="text-gray-700 font-medium flex items-center gap-2">
                                    <i class="fa-solid fa-truck text-jm-orange"></i>
                                    Envío
                                </span>
                                <span class="text-sm text-gray-600">A calcular</span>
                            </div>
                            
                            <!-- Total Final -->
                            <div class="bg-gradient-to-r from-jm-orange/10 to-orange-100 border-2 border-jm-orange/30 p-5 rounded-xl">
                                <div class="flex justify-between items-center mb-2">
                                    <span class="text-lg font-bold text-gray-900">Total a Pagar:</span>
                                    <span class="text-3xl font-bold text-jm-orange">${{ number_format($granTotal, 0, ',', '.') }}</span>
                                </div>
                                <p class="text-xs text-gray-600 text-right">* Sin incluir costos de envío</p>
                            </div>
                        </div>

                        <!-- Botón de Pago -->
                        @if(Auth::check())
                            <form action="{{ route('checkout.store') }}" method="POST">
                                @csrf
                                <button type="submit" 
                                    class="w-full text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3 group text-lg"
                                    style="background: linear-gradient(to right, #f97316, #ff6500);">
                                    <i class="fa-solid fa-credit-card"></i>
                                    <span>💳 Proceder al Pago</span>
                                    <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('checkout.public.index') }}" 
                               class="w-full text-white font-bold py-4 px-6 rounded-xl shadow-lg hover:shadow-2xl transition-all transform hover:-translate-y-1 flex items-center justify-center gap-3 group block text-lg"
                               style="background: linear-gradient(to right, #f97316, #ff6500);">
                                <i class="fa-solid fa-credit-card"></i>
                                <span>💳 Proceder al Pago</span>
                                <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        @endif

                        <!-- Información de Seguridad -->
                        <div class="mt-4 p-4 bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 rounded-lg">
                            <div class="flex items-center gap-2 mb-2">
                                <i class="fa-solid fa-shield-halved text-blue-600"></i>
                                <span class="text-sm font-semibold text-blue-900">Pago seguro con Webpay Plus</span>
                            </div>
                            <p class="text-xs text-blue-800">
                                Serás redirigido a la pasarela de pago de Transbank
                            </p>
                        </div>

                        <!-- Botón Seguir Comprando -->
                        <a href="{{ route('catalogo.index') }}" class="mt-4 block w-full text-center px-6 py-3 border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-100 transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-arrow-left"></i>
                            Seguir Comprando
                        </a>

                        <!-- Características de seguridad -->
                        <div class="mt-6 pt-6 border-t border-gray-200 space-y-3">
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <i class="fa-solid fa-shield-halved text-green-600"></i>
                                <span>Pago 100% seguro</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <i class="fa-solid fa-truck text-blue-600"></i>
                                <span>Envío coordinado</span>
                            </div>
                            <div class="flex items-center gap-3 text-sm text-gray-600">
                                <i class="fa-solid fa-headset text-purple-600"></i>
                                <span>Soporte al cliente</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<style>
@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

/* Scroll personalizado para el resumen */
.overflow-y-auto::-webkit-scrollbar {
    width: 6px;
}

.overflow-y-auto::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.overflow-y-auto::-webkit-scrollbar-thumb {
    background: #cbd5e0;
    border-radius: 10px;
}

.overflow-y-auto::-webkit-scrollbar-thumb:hover {
    background: #a0aec0;
}
</style>

@endsection