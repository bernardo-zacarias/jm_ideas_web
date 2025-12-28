@extends('layouts.app')

@section('title', 'Catálogo de Productos')

{{-- Usamos la sección 'content' para el diseño principal --}}
@section('content')

    <div class="max-w-7xl mx-auto p-8">
        <a href="{{ route('catalogo.index') }}" class="inline-flex items-center gap-2 text-jm-orange hover:text-jm-orange/80 font-semibold mb-8 group transition-all">
            <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Volver al Catálogo
        </a>

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-xl mb-8 shadow-lg">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="font-bold text-red-800 mb-2">⚠️ Por favor, corrige los siguientes errores:</p>
                        <ul class="list-disc ml-5 text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
                
                <div class="p-8 lg:p-12 bg-gradient-to-br from-gray-50 to-white">
                    <div class="relative group mb-8">
                        <div class="absolute inset-0 bg-gradient-to-br from-jm-orange/20 to-cyan-400/20 rounded-2xl transform group-hover:scale-105 transition-transform duration-300"></div>
                        <img 
                            src="{{ $producto->imagen ? asset('images/productos/' . $producto->imagen) : 'https://via.placeholder.com/600x600?text=Sin+Imagen' }}" 
                            alt="{{ $producto->nombre }}" 
                            class="relative w-full rounded-2xl shadow-xl object-cover aspect-square"
                            onerror="this.src='https://via.placeholder.com/600x600?text=Imagen+No+Disponible'"
                        >
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-1 h-8 bg-gradient-to-b from-jm-orange to-cyan-400 rounded-full"></div>
                            <h2 class="text-3xl font-bold text-gray-800">Descripción del Producto</h2>
                        </div>
                        <p class="text-gray-600 text-lg leading-relaxed pl-6">
                            {{ $producto->descripcion ?? 'Este es un producto de alta calidad diseñado para satisfacer tus necesidades. Contáctanos para más información sobre características específicas.' }}
                        </p>
                    </div>

                    <div class="mt-8 p-6 bg-jm-orange/10 rounded-xl border border-jm-orange/30">
                        <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5 text-jm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Beneficios
                        </h3>
                        <ul class="space-y-2 text-sm text-gray-700">
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-jm-orange rounded-full"></span>
                                Alta calidad de impresión
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-jm-orange rounded-full"></span>
                                Entrega rápida y segura
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="w-1.5 h-1.5 bg-jm-orange rounded-full"></span>
                                Soporte personalizado
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="p-8 lg:p-12 space-y-8">
                    <div>
                        <div class="inline-block px-4 py-2 bg-jm-orange/20 text-jm-orange rounded-full text-sm font-semibold mb-4">
                            {{ $producto->categoria->nombre ?? 'Producto' }}
                        </div>
                        <h1 class="text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                            {{ $producto->nombre }}
                        </h1>
                    </div>

                    <div class="p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-2xl border-2 border-green-200 shadow-lg">
                        <div class="flex items-baseline gap-3 mb-3">
                            <p class="text-5xl font-extrabold text-green-700">
                                ${{ number_format($producto->precio, 0, ',', '.') }}
                            </p>
                            <span class="text-gray-600 text-lg">CLP</span>
                        </div>
                        <div class="flex items-center gap-2 text-gray-700">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                            <p class="font-semibold">Stock disponible: <span class="text-green-700">{{ $producto->stock }} unidades</span></p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Design Preview Section (when design is loaded) -->
                        <div id="designPreviewSection" class="p-6 bg-gradient-to-br from-jm-orange/10 to-cyan-400/10 rounded-2xl border-2 border-jm-orange/50 shadow-lg hidden">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-8 h-8 bg-jm-orange rounded-full flex items-center justify-center">
                                    <i class="fa-solid fa-check text-white font-bold"></i>
                                </div>
                                <h3 class="text-xl font-bold text-gray-800">Diseño Personalizado Detectado</h3>
                            </div>
                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                <div class="flex-shrink-0">
                                    <img id="designPreviewImg" src="" alt="Tu diseño" class="w-32 h-32 rounded-xl border-3 border-white shadow-lg object-contain bg-white">
                                </div>
                                <div class="flex-grow">
                                    <p class="text-gray-700 font-semibold mb-2">Tu diseño será aplicado a esta <span class="text-jm-orange">{{ $producto->nombre }}</span></p>
                                    <p class="text-sm text-gray-600 mb-3">El archivo se añadirá automáticamente al carrito con este producto.</p>
                                    <button type="button" id="changeDesignBtn" class="px-4 py-2 bg-white text-jm-orange border-2 border-jm-orange rounded-lg font-bold hover:bg-jm-orange hover:text-white transition-all text-sm">
                                        <i class="fa-solid fa-exchange"></i> Cambiar Diseño
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-1 h-8 bg-gradient-to-b from-jm-orange to-cyan-400 rounded-full"></div>
                            <h3 class="text-2xl font-bold text-gray-800">Añadir al Carrito</h3>
                        </div>
                        
                        <form action="{{ route('carrito.store') }}" method="POST" id="form-catalogo" class="space-y-6" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                                <input type="hidden" name="cotizacion_id" id="input_cotizacion_id" value="{{ $producto->cotizacion->id ?? '' }}"> 
                                <input type="hidden" name="ancho" value="">
                                <input type="hidden" name="alto" value="">
                                <input type="hidden" name="costo_final" id="input_costo_final" value="">
                                <input type="hidden" name="requiere_diseno" id="input_requiere_diseno" value="0">
                                <input type="hidden" name="design_data" id="input_design_data" value=""> 

                                <div class="space-y-2">
                                    <label for="cantidad" class="block text-sm font-bold text-gray-700 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-jm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                        </svg>
                                        Cantidad (máx: {{ $producto->stock }})
                                    </label>
                                    <div class="flex items-center gap-2 bg-white border-2 border-jm-orange rounded-xl p-2 shadow-md">
                                        <button type="button" id="btn-menos" class="px-4 py-2 bg-jm-orange text-white rounded-lg font-bold hover:bg-jm-orange/90 transition-colors">−</button>
                                        <input type="number" name="cantidad" id="cantidad" min="1" max="{{ $producto->stock }}" value="{{ old('cantidad', 1) }}" 
                                               class="flex-1 border-0 p-2 text-center text-2xl font-bold text-jm-orange bg-transparent focus:outline-none" required>
                                        <button type="button" id="btn-mas" class="px-4 py-2 bg-jm-orange text-white rounded-lg font-bold hover:bg-jm-orange/90 transition-colors">+</button>
                                    </div>
                                    @error('cantidad')<p class="text-red-500 text-sm mt-1 flex items-center gap-1"><span>⚠️</span>{{ $message }}</p>@enderror
                                </div>

                                <div class="p-6 bg-gradient-to-br from-cyan-50 to-jm-orange/10 rounded-2xl border-2 border-jm-orange/30 space-y-4 shadow-lg">
                                    <label class="block text-base font-bold text-gray-800 flex items-center gap-2">
                                        <svg class="w-6 h-6 text-jm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                        Opciones de Archivo
                                        <span class="ml-auto text-xs bg-jm-orange text-white px-2 py-1 rounded-full">Obligatorio</span>
                                    </label>
                                    
                                    <label class="flex items-start gap-3 p-4 bg-white rounded-xl border-2 border-gray-200 cursor-pointer hover:border-jm-orange hover:shadow-md transition-all group">
                                        <input type="radio" id="subir_archivo" name="opcion_archivo" value="subir" 
                                               class="mt-1 h-5 w-5 text-jm-orange border-gray-300 focus:ring-jm-orange" required checked>
                                        <div class="flex-1">
                                            <span class="font-semibold text-gray-800 group-hover:text-jm-orange transition-colors">
                                                Yo proporciono el archivo de impresión
                                            </span>
                                            <p class="text-sm text-green-600 font-medium mt-1">✓ Sin costo adicional</p>
                                        </div>
                                    </label>

                                    <label class="flex items-start gap-3 p-4 bg-white rounded-xl border-2 border-gray-200 cursor-pointer hover:border-cyan-400 hover:shadow-md transition-all group">
                                        <input type="radio" id="solicitar_diseno" name="opcion_archivo" value="diseno" 
                                               class="mt-1 h-5 w-5 text-cyan-400 border-gray-300 focus:ring-cyan-300">
                                        <div class="flex-1">
                                            <span class="font-semibold text-gray-800 group-hover:text-cyan-400 transition-colors">
                                                Solicitar Diseño Gráfico Profesional
                                            </span>
                                            <p class="text-sm text-cyan-600 font-medium mt-1">+ $10.000 CLP</p>
                                        </div>
                                    </label>

                                    <div class="pt-4 border-t-2 border-jm-orange/30">
                                        <label for="archivo_diseno" class="block text-sm font-semibold text-gray-700 mb-3 flex items-center gap-2">
                                            <svg class="w-5 h-5 text-jm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                                            </svg>
                                            Subir tu Archivo de Impresión
                                            <span class="text-xs text-gray-500" id="file-upload-status"> (Máx. 10MB)</span>
                                        </label>
                                        <input type="file" name="archivo_diseno" id="archivo_diseno" 
                                               class="w-full p-3 border-2 border-dashed border-gray-300 rounded-xl focus:ring-4 focus:ring-jm-orange/20 focus:border-jm-orange transition-all hover:border-jm-orange cursor-pointer bg-white"/>
                                        <p class="text-xs text-gray-500 mt-2">Formatos aceptados: PDF, PNG, JPG, AI.</p>
                                    </div>
                                </div>

                                <button type="submit" id="btn-add-to-cart" class="group relative w-full overflow-hidden rounded-xl bg-jm-orange hover:bg-jm-orange/90 px-8 py-4 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 enabled:hover:shadow-orange-500/50 disabled:bg-gray-400 disabled:cursor-not-allowed disabled:hover:scale-100 disabled:opacity-75">
                                    <div class="relative flex items-center justify-center gap-3">
                                        <svg class="w-6 h-6 text-white group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                        </svg>
                                        <span class="text-lg font-bold text-white">
                                            Añadir al Carrito
                                        </span>
                                        <svg class="w-5 h-5 text-white group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                        </svg>
                                    </div>
                                </button>
                            </form>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        console.log('Script iniciado');
        
        // Constantes
        const COSTO_DISENO = 10000;
        const PRECIO_PRODUCTO = {{ $producto->precio }};
        const MAX_STOCK = {{ $producto->stock }};

        document.addEventListener('DOMContentLoaded', function () {
            console.log('DOM Loaded - buscando elementos...');
            
            const radioSubir = document.getElementById('subir_archivo');
            const radioDiseno = document.getElementById('solicitar_diseno');
            const inputFile = document.getElementById('archivo_diseno');
            const btnAddToCart = document.getElementById('btn-add-to-cart');
            const cantidadInput = document.getElementById('cantidad');
            const btnMas = document.getElementById('btn-mas');
            const btnMenos = document.getElementById('btn-menos');
            
            console.log('Elementos encontrados:', {
                radioSubir: !!radioSubir,
                radioDiseno: !!radioDiseno,
                inputFile: !!inputFile,
                btnAddToCart: !!btnAddToCart,
                cantidadInput: !!cantidadInput,
                btnMas: !!btnMas,
                btnMenos: !!btnMenos
            });
            
            // Función para calcular costo final
            function calculateCost() {
                const cantidad = parseInt(cantidadInput.value) || 1;
                const costoProducto = PRECIO_PRODUCTO * cantidad;
                const costoDiseno = radioDiseno.checked ? COSTO_DISENO : 0;
                const costoTotal = costoProducto + costoDiseno;
                
                document.getElementById('input_costo_final').value = costoTotal;
                document.getElementById('input_requiere_diseno').value = radioDiseno.checked ? '1' : '0';
            }
            
            // Función para verificar si el botón debe estar habilitado
            function updateButtonState() {
                const cantidadValue = parseInt(cantidadInput.value) || 0;
                const isQuantityValid = cantidadValue >= 1 && cantidadValue <= MAX_STOCK;
                const isOptionSelected = radioSubir.checked || radioDiseno.checked;
                
                let isFormValid = false;

                if (isQuantityValid && isOptionSelected) {
                    if (radioDiseno.checked) {
                        isFormValid = true;
                    } else if (radioSubir.checked) {
                        isFormValid = inputFile.files.length > 0;
                    }
                }
                
                btnAddToCart.disabled = !isFormValid;
                calculateCost();
                
                console.log({
                    cantidadValue,
                    isQuantityValid,
                    isOptionSelected,
                    opcion: radioDiseno.checked ? 'diseno' : 'subir',
                    archivos: inputFile.files.length,
                    bottonEnabled: isFormValid
                });
            }

            // Event Listeners para botones +/-
            console.log('Agregando listeners a botones +/-...');
            
            if (btnMas) {
                btnMas.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Click en +');
                    const cantidad = parseInt(cantidadInput.value) || 1;
                    if (cantidad < MAX_STOCK) {
                        cantidadInput.value = cantidad + 1;
                        console.log('Nueva cantidad:', cantidadInput.value);
                        updateButtonState();
                    }
                    return false;
                });
            }

            if (btnMenos) {
                btnMenos.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    console.log('Click en -');
                    const cantidad = parseInt(cantidadInput.value) || 1;
                    if (cantidad > 1) {
                        cantidadInput.value = cantidad - 1;
                        console.log('Nueva cantidad:', cantidadInput.value);
                        updateButtonState();
                    }
                    return false;
                });
            }

            // Event Listeners para cambios
            if (radioSubir) radioSubir.addEventListener('change', function() {
                console.log('Cambio en "Subir archivo"');
                updateButtonState();
            });
            
            if (radioDiseno) radioDiseno.addEventListener('change', function() {
                console.log('Cambio en "Solicitar diseño"');
                updateButtonState();
            });
            
            if (inputFile) inputFile.addEventListener('change', function() {
                console.log('Archivo seleccionado:', this.files.length);
                updateButtonState();
            });
            
            if (cantidadInput) {
                cantidadInput.addEventListener('input', function() {
                    console.log('Input cantidad:', this.value);
                    updateButtonState();
                });
                cantidadInput.addEventListener('change', function() {
                    console.log('Change cantidad:', this.value);
                    updateButtonState();
                });
            }

            // Inicializar estado
            console.log('Inicializando estado del botón...');
            updateButtonState();

            // ===== DETECCIÓN DE DISEÑO GUARDADO =====
            const currentProductId = {{ $producto->id }};
            const designedProductKey = 'designedProduct_' + currentProductId;
            const designedProductData = sessionStorage.getItem(designedProductKey);
            const customDesignData = sessionStorage.getItem('customDesign');

            if (designedProductData) {
                try {
                    const designData = JSON.parse(designedProductData);
                    
                    // Mostrar sección de preview de diseño
                    const previewSection = document.getElementById('designPreviewSection');
                    const previewImg = document.getElementById('designPreviewImg');
                    
                    if (previewSection && previewImg) {
                        previewSection.classList.remove('hidden');
                        previewImg.src = designData.design.designImage;
                        
                        // Guardar datos de diseño en el input hidden
                        const designInput = document.getElementById('input_design_data');
                        if (designInput) {
                            designInput.value = JSON.stringify(designData.design);
                        }
                    }
                    
                    // Botón para cambiar diseño
                    const changeDesignBtn = document.getElementById('changeDesignBtn');
                    if (changeDesignBtn) {
                        changeDesignBtn.addEventListener('click', function() {
                            // Limpiar datos de este producto
                            sessionStorage.removeItem(designedProductKey);
                            // Volver al catálogo (el customDesign sigue en sessionStorage)
                            window.location.href = "{{ route('catalogo.index') . '?category=7' }}";
                        });
                    }
                    
                    // Al enviar el formulario, incluir el diseño
                    const form = document.getElementById('form-catalogo');
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            // El diseño ya está en el input hidden
                            // Limpiar sessionStorage después de agregar al carrito
                            // (se hará después de la respuesta exitosa)
                        });
                    }
                } catch (e) {
                    console.error('Error al procesar diseño guardado:', e);
                }
            } else if (customDesignData && !designedProductData) {
                // Hay un diseño en sessionStorage pero no es para este producto
                // Mostrar mensaje indicando que el usuario debe seleccionar este producto para aplicar
                console.log('Diseño personalizado disponible - este producto está seleccionado');
            }
        });

        // Limpiar sesión cuando se agrega al carrito exitosamente
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('form-catalogo');
            if (form) {
                // Observar cambios en el DOM para detectar cuando se agregó al carrito
                const originalSubmit = form.onsubmit;
                form.onsubmit = function(e) {
                    // Esperar a que se agregue al carrito
                    const currentProductId = {{ $producto->id }};
                    const designedProductKey = 'designedProduct_' + currentProductId;
                    
                    // Guardar para limpiar después
                    setTimeout(() => {
                        sessionStorage.removeItem(designedProductKey);
                        sessionStorage.removeItem('customDesign');
                    }, 2000);
                    
                    return true;
                };
            }
        });
    </script>
@endpush

@endsection