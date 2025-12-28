@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-12 px-4">
    <div class="max-w-6xl mx-auto">
        <!-- Alertas de Error -->
        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-6 shadow-sm animate-fade-in">
                <div class="flex items-start">
                    <i class="fa-solid fa-exclamation-circle text-2xl mr-3 mt-1"></i>
                    <div class="flex-1">
                        <h3 class="font-bold mb-2">Error en el formulario</h3>
                        <ul class="space-y-1 text-sm">
                            @foreach($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-6 py-4 rounded-lg mb-6 shadow-sm">
                <div class="flex items-center">
                    <i class="fa-solid fa-exclamation-triangle mr-3"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        <!-- Header Principal -->
        <div class="text-center mb-8">
            <h1 class="text-5xl font-bold text-gray-900 mb-3">Finalizar Compra</h1>
            <p class="text-lg text-gray-600">Completa tus datos para procesar tu pedido</p>
            <div class="flex items-center justify-center gap-8 mt-6">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-jm-orange text-white flex items-center justify-center font-bold">1</div>
                    <span class="text-sm font-medium text-gray-700">Revisar Carrito</span>
                </div>
                <div class="w-16 h-1 bg-jm-orange"></div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-jm-orange text-white flex items-center justify-center font-bold">2</div>
                    <span class="text-sm font-medium text-gray-700">Datos de Contacto</span>
                </div>
                <div class="w-16 h-1 bg-gray-300"></div>
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-600 flex items-center justify-center font-bold">3</div>
                    <span class="text-sm font-medium text-gray-500">Pago</span>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-5 gap-8">
            <!-- Formulario de Datos - Columna Principal -->
            <div class="lg:col-span-3 space-y-6">
                <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-200">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                        <div class="w-10 h-10 rounded-full bg-jm-orange/10 flex items-center justify-center">
                            <i class="fa-solid fa-user text-jm-orange text-lg"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900">Datos de Contacto</h2>
                    </div>

                    <form action="{{ route('checkout.guest.store') }}" method="POST" id="checkoutForm">
                        @csrf

                        <div class="space-y-5">
                            <!-- Nombre -->
                            <div class="group">
                                <label for="nombre_cliente" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fa-solid fa-user mr-1 text-gray-400"></i>
                                    Nombre Completo <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="nombre_cliente" 
                                    name="nombre_cliente" 
                                    value="{{ old('nombre_cliente') }}"
                                    class="w-full px-4 py-3 border @error('nombre_cliente') border-red-500 bg-red-50 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-jm-orange focus:border-transparent transition-all"
                                    placeholder="Juan Pérez González"
                                    required
                                >
                                @error('nombre_cliente')
                                    <p class="text-red-600 text-sm mt-1.5 flex items-center gap-1">
                                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Email y Teléfono en Grid -->
                            <div class="grid md:grid-cols-2 gap-5">
                                <!-- Email -->
                                <div>
                                    <label for="email_cliente" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fa-solid fa-envelope mr-1 text-gray-400"></i>
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="email" 
                                        id="email_cliente" 
                                        name="email_cliente" 
                                        value="{{ old('email_cliente') }}"
                                        class="w-full px-4 py-3 border @error('email_cliente') border-red-500 bg-red-50 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-jm-orange focus:border-transparent transition-all"
                                        placeholder="correo@ejemplo.com"
                                        required
                                    >
                                    @error('email_cliente')
                                        <p class="text-red-600 text-sm mt-1.5 flex items-center gap-1">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Teléfono -->
                                <div>
                                    <label for="telefono_cliente" class="block text-sm font-semibold text-gray-700 mb-2">
                                        <i class="fa-solid fa-phone mr-1 text-gray-400"></i>
                                        Teléfono <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="tel" 
                                        id="telefono_cliente" 
                                        name="telefono_cliente" 
                                        value="{{ old('telefono_cliente') }}"
                                        class="w-full px-4 py-3 border @error('telefono_cliente') border-red-500 bg-red-50 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-jm-orange focus:border-transparent transition-all"
                                        placeholder="+56 9 XXXX XXXX"
                                        required
                                    >
                                    @error('telefono_cliente')
                                        <p class="text-red-600 text-sm mt-1.5 flex items-center gap-1">
                                            <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Dirección -->
                            <div>
                                <label for="direccion_cliente" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fa-solid fa-location-dot mr-1 text-gray-400"></i>
                                    Dirección <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="direccion_cliente" 
                                    name="direccion_cliente" 
                                    value="{{ old('direccion_cliente') }}"
                                    class="w-full px-4 py-3 border @error('direccion_cliente') border-red-500 bg-red-50 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-jm-orange focus:border-transparent transition-all"
                                    placeholder="Calle 123, Apto 4B"
                                    required
                                >
                                @error('direccion_cliente')
                                    <p class="text-red-600 text-sm mt-1.5 flex items-center gap-1">
                                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Comuna -->
                            <div>
                                <label for="comuna_cliente" class="block text-sm font-semibold text-gray-700 mb-2">
                                    <i class="fa-solid fa-map-marker-alt mr-1 text-gray-400"></i>
                                    Comuna <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="comuna_cliente" 
                                    name="comuna_cliente" 
                                    value="{{ old('comuna_cliente') }}"
                                    class="w-full px-4 py-3 border @error('comuna_cliente') border-red-500 bg-red-50 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-jm-orange focus:border-transparent transition-all"
                                    placeholder="Santiago, Providencia, Las Condes, etc."
                                    required
                                >
                                @error('comuna_cliente')
                                    <p class="text-red-600 text-sm mt-1.5 flex items-center gap-1">
                                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Campos ocultos -->
                            <input type="hidden" name="carrito_items" id="carrito_items" value="{{ json_encode($items ?? []) }}">
                            <input type="hidden" name="total" value="{{ $total ?? 0 }}">

                            <!-- Nota informativa -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-4 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <i class="fa-solid fa-info-circle text-blue-600 text-xl mt-0.5"></i>
                                    <div>
                                        <p class="text-sm font-semibold text-blue-900 mb-1">Información importante</p>
                                        <p class="text-sm text-blue-800">
                                            Estos datos se utilizarán para gestionar tu diseño y coordinar la entrega de tu pedido.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                <a 
                                    href="{{ route('carrito.index') }}" 
                                    class="flex-1 px-6 py-3.5 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all text-center border border-gray-300 flex items-center justify-center gap-2"
                                >
                                    <i class="fa-solid fa-arrow-left"></i>
                                    Volver al Carrito
                                </a>
                                <button 
                                    type="submit" 
                                    id="submitBtn"
                                    class="flex-1 px-6 py-3.5 bg-jm-orange text-white rounded-xl font-bold text-lg hover:bg-orange-600 transition-all shadow-lg hover:shadow-2xl transform hover:-translate-y-1 flex items-center justify-center gap-2"
                                >
                                    💳 Continuar al Pago
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Resumen del Pedido - Sidebar -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-200 sticky top-4">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                        <div class="w-10 h-10 rounded-full bg-jm-orange/10 flex items-center justify-center">
                            <i class="fa-solid fa-shopping-cart text-jm-orange text-lg"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Resumen del Pedido</h2>
                    </div>
                    
                    <div class="space-y-3 mb-6 max-h-96 overflow-y-auto">
                        @if(isset($items) && count($items) > 0)
                            @foreach($items as $item)
                                <div class="flex gap-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                    <div class="flex-1">
                                        <p class="font-semibold text-gray-900 text-sm mb-1">{{ $item['producto_nombre'] ?? 'Producto' }}</p>
                                        <div class="flex flex-wrap gap-x-3 gap-y-1 text-xs text-gray-600">
                                            <span class="flex items-center gap-1">
                                                <i class="fa-solid fa-hashtag"></i>
                                                Cant: {{ $item['cantidad'] ?? 1 }}
                                            </span>
                                            @if(!empty($item['ancho']) || !empty($item['alto']))
                                                <span class="flex items-center gap-1">
                                                    <i class="fa-solid fa-ruler-combined"></i>
                                                    {{ $item['ancho'] ?? '-' }} x {{ $item['alto'] ?? '-' }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-bold text-gray-900">${{ number_format($item['costo_final'] ?? 0, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <i class="fa-solid fa-shopping-cart text-gray-300 text-4xl mb-3"></i>
                                <p class="text-gray-500">Tu carrito está vacío</p>
                            </div>
                        @endif
                    </div>

                    <!-- Total -->
                    <div class="bg-gradient-to-r from-jm-orange/10 to-orange-100 border-2 border-jm-orange/30 p-5 rounded-xl">
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-sm font-medium text-gray-700">Subtotal:</p>
                            <p class="text-lg font-semibold text-gray-900">${{ number_format($total ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="border-t border-jm-orange/20 my-3"></div>
                        <div class="flex justify-between items-center">
                            <p class="text-lg font-bold text-gray-900">Total a Pagar:</p>
                            <p class="text-3xl font-bold text-jm-orange">${{ number_format($total ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>

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

/* Mejoras en inputs */
input:focus {
    outline: none;
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

<script>
// Validación del formulario
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    const nombre = document.getElementById('nombre_cliente').value.trim();
    const email = document.getElementById('email_cliente').value.trim();
    const phone = document.getElementById('telefono_cliente').value.trim();
    const direccion = document.getElementById('direccion_cliente').value.trim();
    const comuna = document.getElementById('comuna_cliente').value.trim();
    
    // Validación de campos no vacíos
    if (!nombre || !email || !phone || !direccion || !comuna) {
        e.preventDefault();
        alert('⚠️ Por favor, completa todos los campos requeridos');
        return false;
    }
    
    // Validación simple de email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        e.preventDefault();
        alert('⚠️ Por favor, ingresa un email válido');
        return false;
    }
    
    // Validación simple de teléfono (mínimo 8 caracteres numéricos)
    if (phone.replace(/\D/g, '').length < 8) {
        e.preventDefault();
        alert('⚠️ Por favor, ingresa un teléfono válido (mínimo 8 dígitos)');
        return false;
    }

    // Deshabilitar botón durante envío
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin mr-2"></i> Procesando...';
    submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
});

// Animación suave al hacer scroll a errores
document.addEventListener('DOMContentLoaded', function() {
    const errorElement = document.querySelector('.border-red-500');
    if (errorElement) {
        errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>
@endsection