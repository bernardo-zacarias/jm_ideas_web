@extends('layouts.app')

@section('title', 'Confirmación de Pedido')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4">
    <div class="max-w-6xl mx-auto">
        
        <!-- Indicador de Progreso -->
        <div class="text-center mb-8">
            <h1 class="text-5xl font-bold text-gray-900 mb-3">
                @if($pedido->estado === 'pago_rechazado')
                    Pago Rechazado
                @else
                    Confirmación de Pedido
                @endif
            </h1>
            <p class="text-lg text-gray-600 mb-6">Paso 3 de 3</p>
            
            <div class="flex items-center justify-center gap-8 mt-8">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold shadow-lg">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-500">Revisar Carrito</span>
                </div>
                <div class="w-20 h-1 bg-green-500 rounded"></div>
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-green-500 text-white flex items-center justify-center font-bold shadow-lg">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <span class="text-sm font-medium text-gray-500">Datos de Contacto</span>
                </div>
                <div class="w-20 h-1 bg-jm-orange rounded"></div>
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-jm-orange text-white flex items-center justify-center font-bold shadow-lg">3</div>
                    <span class="text-sm font-semibold text-jm-orange">Confirmación</span>
                </div>
            </div>
        </div>

        <!-- Alertas de Sesión -->
        @if (session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-6 py-4 rounded-lg mb-6 shadow-sm animate-fade-in">
                <div class="flex items-start">
                    <i class="fa-solid fa-check-circle text-2xl mr-3 mt-1"></i>
                    <div class="flex-1">
                        <p class="font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-6 shadow-sm">
                <div class="flex items-start">
                    <i class="fa-solid fa-exclamation-triangle text-2xl mr-3 mt-1"></i>
                    <div class="flex-1">
                        <p class="font-semibold">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Columna Principal: Información del Pedido -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Card de Estado del Pedido -->
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
                    @if($pedido->estado === 'pago_rechazado')
                        <!-- Estado: Pago Rechazado -->
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-times-circle text-red-600 text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-3xl font-bold text-red-600 mb-2">Pago Rechazado</h2>
                                <p class="text-gray-600 mb-1">Tu pago no pudo ser procesado</p>
                                <p class="text-sm text-gray-500">
                                    Número de pedido: <span class="font-bold text-red-600">#{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg mb-6">
                            <p class="text-red-800 mb-4">Desafortunadamente, tu pago no pudo ser procesado. Por favor, intenta nuevamente con otro medio de pago.</p>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="{{ route('transbank.iniciar', $pedido->id) }}" 
                                   class="flex-1 px-6 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-all shadow-lg text-center flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-rotate-right"></i>
                                    Intentar Nuevamente
                                </a>
                                <a href="{{ route('carrito.index') }}" 
                                   class="flex-1 px-6 py-3 bg-gray-600 text-white font-bold rounded-xl hover:bg-gray-700 transition-all shadow-lg text-center flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-shopping-cart"></i>
                                    Volver al Carrito
                                </a>
                            </div>
                        </div>

                    @elseif($pedido->estado === 'pendiente_pago')
                        <!-- Estado: Pendiente de Pago -->
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-16 h-16 rounded-full bg-yellow-100 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-clock text-yellow-600 text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-3xl font-bold text-yellow-600 mb-2">Pendiente de Pago</h2>
                                <p class="text-gray-600 mb-1">Tu pedido ha sido creado exitosamente</p>
                                <p class="text-sm text-gray-500">
                                    Número de pedido: <span class="font-bold text-jm-orange">#{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</span>
                                </p>
                            </div>
                        </div>

                        <div class="bg-gradient-to-r from-jm-orange/10 to-orange-100 border-l-4 border-jm-orange p-4 rounded-lg">
                            <div class="flex items-center gap-3 mb-4">
                                <i class="fa-solid fa-info-circle text-jm-orange text-xl"></i>
                                <p class="text-gray-900 font-semibold">Completa tu pago para confirmar el pedido</p>
                            </div>
                            <a href="{{ route('transbank.iniciar', $pedido->id) }}" 
                               class="inline-block w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-jm-orange to-orange-600 text-white font-bold rounded-xl hover:from-orange-600 hover:to-jm-orange transition-all shadow-lg text-center transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <i class="fa-solid fa-credit-card"></i>
                                Pagar con Webpay
                            </a>
                        </div>

                    @else
                        <!-- Estado: Pago Confirmado -->
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-check-circle text-green-600 text-3xl"></i>
                            </div>
                            <div class="flex-1">
                                <h2 class="text-3xl font-bold text-green-600 mb-2">¡Pedido Confirmado!</h2>
                                <p class="text-gray-600 mb-1">Tu compra ha sido registrada exitosamente</p>
                                <p class="text-sm text-gray-500">
                                    Número de pedido: <span class="font-bold text-jm-orange">#{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}</span>
                                </p>
                            </div>
                        </div>

                        @if($pedido->estado === 'pagado')
                            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <i class="fa-solid fa-shield-halved text-green-600 text-xl mt-0.5"></i>
                                    <div>
                                        <p class="text-green-800 font-bold mb-1">✓ Pago Confirmado</p>
                                        @if($pedido->transbank_authorization_code)
                                            <p class="text-sm text-green-700">Código de autorización: <span class="font-mono font-semibold">{{ $pedido->transbank_authorization_code }}</span></p>
                                            <p class="text-sm text-green-700">Método de pago: {{ $pedido->transbank_payment_type_code == 'VD' ? 'Tarjeta de Débito' : ($pedido->transbank_payment_type_code == 'VN' ? 'Tarjeta de Crédito' : 'Webpay') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    <!-- Detalles del Pedido -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Fecha del pedido</p>
                                <p class="font-semibold text-gray-900">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total pagado</p>
                                <p class="text-2xl font-bold text-jm-orange">${{ number_format($pedido->total, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card de Productos -->
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="flex items-center gap-3 bg-gradient-to-r from-jm-orange/10 to-orange-50 p-6 border-b border-gray-200">
                        <div class="w-10 h-10 rounded-full bg-jm-orange/20 flex items-center justify-center">
                            <i class="fa-solid fa-box text-jm-orange text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Productos Comprados</h2>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @foreach ($items as $item)
                            @php
                                $esCotizado = $item->ancho > 0 || $item->alto > 0;
                                $nombreProducto = $item->producto->nombre ?? ($item->cotizacion->nombre ?? 'Ítem desconocido');
                                $origen = $esCotizado ? 'Cotización Personalizada' : 'Catálogo';
                            @endphp
                            
                            <div class="p-6 hover:bg-gray-50 transition-colors">
                                <div class="flex flex-col md:flex-row gap-4 justify-between">
                                    <div class="flex-1">
                                        <div class="flex items-start gap-3 mb-3">
                                            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-jm-orange to-orange-600 flex items-center justify-center flex-shrink-0">
                                                <i class="fa-solid fa-box text-white text-lg"></i>
                                            </div>
                                            <div class="flex-1">
                                                <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $nombreProducto }}</h3>
                                                <span class="inline-block px-3 py-1 bg-jm-orange/10 text-jm-orange rounded-full text-xs font-bold">
                                                    {{ $origen }}
                                                </span>
                                            </div>
                                        </div>
                                        
                                        <div class="space-y-2 text-sm ml-15">
                                            <div class="flex items-center gap-2 text-gray-700">
                                                <i class="fa-solid fa-hashtag text-jm-orange"></i>
                                                <span><strong>Cantidad:</strong> {{ $item->cantidad }}</span>
                                                @if ($esCotizado)
                                                    <span class="mx-1">|</span>
                                                    <i class="fa-solid fa-ruler-combined text-jm-orange"></i>
                                                    <span><strong>Medidas:</strong> {{ $item->ancho }}m x {{ $item->alto }}m</span>
                                                @endif
                                            </div>
                                            
                                            <div class="flex items-center gap-2 {{ $item->requiere_diseno ? 'text-purple-600' : 'text-green-600' }}">
                                                <i class="fa-solid fa-paintbrush"></i>
                                                <span><strong>Diseño:</strong> {{ $item->requiere_diseno ? 'Solicitado (+$10.000)' : 'Proporcionado por cliente' }}</span>
                                            </div>
                                            
                                            @if($item->ruta_archivo)
                                                @php
                                                    $extension = pathinfo($item->ruta_archivo, PATHINFO_EXTENSION);
                                                    $esImagen = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
                                                @endphp
                                                <div class="flex items-center gap-2 mt-3">
                                                    <span class="px-3 py-1.5 bg-green-100 text-green-700 text-xs font-semibold rounded-lg flex items-center gap-1">
                                                        <i class="fa-solid fa-check"></i>
                                                        Archivo adjunto
                                                    </span>
                                                    @if($esImagen)
                                                        <button onclick="verArchivo('{{ asset('storage/' . $item->ruta_archivo) }}', '{{ basename($item->ruta_archivo) }}')" 
                                                                class="px-3 py-1.5 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 text-xs font-semibold rounded-lg transition-colors flex items-center gap-1">
                                                            <i class="fa-solid fa-eye"></i>
                                                            Ver imagen
                                                        </button>
                                                    @endif
                                                    <a href="{{ asset('storage/' . $item->ruta_archivo) }}" 
                                                       download
                                                       class="px-3 py-1.5 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-semibold rounded-lg transition-colors flex items-center gap-1">
                                                        <i class="fa-solid fa-download"></i>
                                                        Descargar
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="text-right md:text-left">
                                        <p class="text-sm text-gray-600 mb-1">Subtotal</p>
                                        <p class="text-2xl font-bold text-jm-orange">
                                            ${{ number_format($item->costo_final, 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Botón Ver Historial -->
                <div class="text-center">
                    <a href="{{ route('pedidos.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all border border-gray-300">
                        <i class="fa-solid fa-history"></i>
                        Ver mi Historial de Pedidos
                    </a>
                </div>
            </div>

            <!-- Sidebar: Información de Contacto -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200 sticky top-4">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                        <div class="w-10 h-10 rounded-full bg-jm-orange/10 flex items-center justify-center">
                            <i class="fa-solid fa-headset text-jm-orange text-lg"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Contacto JM Ideas</h3>
                    </div>

                    <div class="space-y-4">
                        <!-- WhatsApp -->
                        <a href="https://wa.me/56978515292?text=Hola%20JM%20Ideas,%20tengo%20una%20consulta%20sobre%20mi%20pedido%20%23{{ str_pad($pedido->id, 6, '0', STR_PAD_LEFT) }}" 
                           target="_blank"
                           class="flex items-start gap-3 p-4 bg-green-50 rounded-xl hover:bg-green-100 transition-all border border-green-200 group">
                            <div class="w-10 h-10 rounded-lg bg-green-500 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-brands fa-whatsapp text-white text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 mb-1">WhatsApp</p>
                                <p class="text-green-600 text-sm font-medium">+56 9 7851 5292</p>
                            </div>
                            <i class="fa-solid fa-external-link text-green-600 mt-3"></i>
                        </a>

                        <!-- Email -->
                        <a href="mailto:info@jmideas.cl" 
                           class="flex items-start gap-3 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition-all border border-blue-200 group">
                            <div class="w-10 h-10 rounded-lg bg-blue-500 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-envelope text-white text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 mb-1">Email</p>
                                <p class="text-blue-600 text-sm font-medium break-all">info@jmideas.cl</p>
                            </div>
                        </a>

                        <!-- Ubicación -->
                        <div class="flex items-start gap-3 p-4 bg-purple-50 rounded-xl border border-purple-200">
                            <div class="w-10 h-10 rounded-lg bg-purple-500 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-map-marker-alt text-white text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 mb-1">Ubicación</p>
                                <p class="text-gray-700 text-sm">Padre Hurtado 7358<br>Cerro Navia, Santiago</p>
                            </div>
                        </div>

                        <!-- Horario -->
                        <div class="flex items-start gap-3 p-4 bg-orange-50 rounded-xl border border-orange-200">
                            <div class="w-10 h-10 rounded-lg bg-orange-500 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-clock text-white text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900 mb-1">Horario</p>
                                <p class="text-gray-700 text-sm">
                                    <strong>L-V:</strong> 9:00 - 18:00<br>
                                    <strong>Sábados:</strong> 10:00 - 14:00
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Nota informativa -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-4 rounded-lg">
                            <div class="flex items-start gap-2">
                                <i class="fa-solid fa-info-circle text-blue-600 text-lg mt-0.5"></i>
                                <p class="text-sm text-blue-900">
                                    Tu pedido será procesado por nuestro equipo lo antes posible. Nos contactaremos contigo si es necesario aclarar algo sobre tu compra.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver archivos -->
<div id="archivoModal" class="fixed inset-0 bg-black bg-opacity-90 hidden items-center justify-center z-50 p-4" onclick="cerrarArchivo()">
    <div class="relative max-w-5xl w-full" onclick="event.stopPropagation()">
        <div class="bg-white rounded-t-xl p-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <i class="fa-solid fa-image text-indigo-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="font-bold text-gray-900">Vista Previa</h3>
                    <p id="archivoNombre" class="text-sm text-gray-600"></p>
                </div>
            </div>
            <button onclick="cerrarArchivo()" class="bg-red-100 hover:bg-red-200 text-red-600 rounded-lg w-10 h-10 flex items-center justify-center transition-colors">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="bg-gray-900 rounded-b-xl p-6 flex items-center justify-center" style="max-height: calc(100vh - 150px); overflow: auto;">
            <img id="archivoImagen" src="" alt="Vista previa" class="max-w-full max-h-full rounded-lg shadow-2xl">
        </div>
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
</style>

@push('scripts')
<script>
function verArchivo(url, nombre) {
    const modal = document.getElementById('archivoModal');
    const img = document.getElementById('archivoImagen');
    const nombreEl = document.getElementById('archivoNombre');
    
    img.src = url;
    nombreEl.textContent = nombre;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function cerrarArchivo() {
    const modal = document.getElementById('archivoModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        cerrarArchivo();
    }
});
</script>
@endpush

@endsection