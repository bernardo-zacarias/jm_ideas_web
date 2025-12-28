@extends('layouts.app')

@section('title', 'Catálogo de Productos')

@section('content')

<style>
    .jm-orange { color: #f97316; }
    .bg-jm-orange { background-color: #f97316; }
    .bg-jm-black { background-color: #000000; }
    
    .product-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .filter-btn.active {
        background-color: #f97316;
        color: white;
        border-color: #f97316;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-fade {
        animation: fadeIn 0.5s ease forwards;
    }

    /* Efecto de Borde Negro en Letras - Título */
    .text-stroke {
        -webkit-text-stroke: 2px #000000;
        text-stroke: 2px #000000;
        paint-order: stroke fill;
    }

    /* Efecto de Borde Negro en Letras - Subtítulo (más delgado) */
    .text-stroke-sm {
        -webkit-text-stroke: 1px #000000;
        text-stroke: 1px #000000;
        paint-order: stroke fill;
    }

    /* Imagen de fondo sin efecto */
    .hero-bg-image {
        animation: none;
    }

    /* Diseño Guardado Banner */
    .design-loaded-banner {
        background: linear-gradient(135deg, #f97316 0%, #06b6d4 100%);
        box-shadow: 0 10px 30px rgba(249, 115, 22, 0.2);
        animation: slideDown 0.5s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .design-preview-thumb {
        max-width: 150px;
        max-height: 150px;
        border-radius: 12px;
        border: 3px solid white;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .apply-design-btn {
        background: linear-gradient(135deg, #f97316 0%, #ff6500 100%);
        color: white;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        font-weight: 700;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(249, 115, 22, 0.3);
    }

    .apply-design-btn:hover {
        background: linear-gradient(135deg, #ff6500 0%, #f97316 100%);
        transform: translateX(4px) translateY(-2px);
        box-shadow: 0 8px 25px rgba(249, 115, 22, 0.5);
    }

    .apply-design-btn::after {
        content: '';
        position: absolute;
        right: -3px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-left: 8px solid currentColor;
        border-top: 5px solid transparent;
        border-bottom: 5px solid transparent;
    }

    .product-with-design {
        border: 2px solid #f97316;
        background: linear-gradient(135deg, rgba(249, 115, 22, 0.05) 0%, rgba(6, 182, 212, 0.05) 100%);
    }
</style>

<!-- Banner de Diseño Cargado (si existe) -->
<div id="designLoadedSection" style="display: none;">
    <div class="design-loaded-banner text-white py-6 px-6 mb-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <div class="flex-shrink-0">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-check-circle text-4xl text-white"></i>
                    </div>
                </div>
                <div class="flex-grow">
                    <h2 class="text-2xl md:text-3xl font-black mb-2">✨ Diseño Personalizado Cargado</h2>
                    <p class="text-white/90 text-lg">Tu diseño está listo. Ahora selecciona una <strong>Taza</strong> para aplicarlo.</p>
                </div>
                <div class="flex-shrink-0">
                    <img id="designPreviewImage" src="" alt="Preview" class="design-preview-thumb">
                </div>
                <button id="clearDesignBtn" class="flex-shrink-0 px-4 py-2 bg-white/20 hover:bg-white/30 rounded-lg font-bold transition-all text-sm">
                    <i class="fa-solid fa-trash"></i> Limpiar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Título Simple Catálogo -->
<div class="bg-white border-b border-gray-200 py-8">
    <div class="max-w-7xl mx-auto px-6">
        @if(isset($termino) && $termino)
            <h1 class="text-4xl md:text-5xl font-black text-gray-800 mb-2">Resultados de búsqueda</h1>
            <p class="text-gray-600 text-lg">Se encontraron <strong>{{ $productos->total() }}</strong> resultado(s) para "<strong>{{ $termino }}</strong>"</p>
        @else
            <h1 class="text-4xl md:text-5xl font-black text-gray-800 mb-2">Nuestro Catálogo</h1>
            <p class="text-gray-600 text-lg">Explora nuestros productos y comienza a diseñar</p>
        @endif
    </div>
</div>

    <main class="max-w-7xl mx-auto px-6 py-16 flex flex-col md:flex-row gap-8">
        
        <!-- Sidebar Filtros (Desktop) -->
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="sticky top-28 space-y-8">
                <div>
                    <h3 class="font-black text-lg mb-4 uppercase tracking-widest text-sm text-jm-black">Categorías</h3>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('catalogo.index') }}" class="filter-btn text-left px-4 py-3 rounded-xl border border-gray-200 font-bold hover:border-jm-orange hover:bg-jm-orange/10 transition-all text-gray-700 @if(!request('category')) active bg-jm-orange text-white @endif">
                            Todos los Productos
                        </a>
                        @foreach($categorias as $categoria)
                            <a href="{{ route('catalogo.index') }}?category={{ $categoria->id }}" class="filter-btn text-left px-4 py-3 rounded-xl border border-gray-200 font-bold hover:border-jm-orange hover:bg-jm-orange/10 transition-all text-gray-700 @if(request('category') == $categoria->id) active bg-jm-orange text-white @endif">
                                {{ $categoria->nombre }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="p-6 bg-gradient-to-br from-jm-orange to-cyan-400 rounded-3xl text-white shadow-lg">
                    <h4 class="font-black mb-2 text-lg">¿Buscas al por Mayor?</h4>
                    <p class="text-sm text-white/90 mb-4">Tenemos precios especiales para empresas y eventos.</p>
                    <a href="{{ route('cotizador.index') }}" class="bg-jm-black text-white w-full py-2 rounded-xl font-bold text-sm hover:bg-white hover:text-jm-black transition-all inline-block text-center">Cotizar Ahora</a>
                </div>
            </div>
        </aside>

        <!-- Product Grid -->
        <section class="flex-grow">
            <!-- Toolbar -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <span class="text-gray-600 font-medium text-sm">
                    <span class="font-black text-jm-orange">{{ $productos->total() }}</span> productos disponibles
                </span>
                <div class="flex gap-2">
                    <select class="bg-white border border-gray-200 rounded-xl px-4 py-2 font-bold text-sm outline-none focus:border-jm-orange">
                        <option>Ordenar por: Destacados</option>
                        <option>Precio: Menor a Mayor</option>
                        <option>Precio: Mayor a Menor</option>
                        <option>Nuevos productos</option>
                    </select>
                </div>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @php
                    $animationDelay = 0.1;
                @endphp

                @forelse($productos as $producto)
                    <div class="product-card bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm hover:shadow-xl animate-fade hover:border-jm-orange transition-all duration-300 apply-design-card" data-product-id="{{ $producto->id }}" style="animation-delay: {{ $animationDelay }}s;">
                        <div class="h-64 bg-gray-100 relative group overflow-hidden">
                            @if($producto->imagen)
                                <img src="{{ asset('images/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            @else
                                <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                    <i class="fa-solid fa-image text-6xl text-gray-300 group-hover:scale-110 transition-transform duration-300"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <div class="mb-2 inline-block px-3 py-1 bg-jm-orange/10 rounded-full">
                                <span class="text-xs font-bold text-jm-orange">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</span>
                            </div>
                            <h3 class="font-black text-lg mb-2 text-jm-black">{{ $producto->nombre }}</h3>
                            <p class="text-gray-500 text-sm mb-4 line-clamp-2">{{ $producto->descripcion ?? 'Personalización disponible' }}</p>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-2xl font-black text-jm-orange">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                                <div class="design-action-buttons flex gap-2">
                                    <button class="apply-design-card-btn apply-design-btn px-5 py-3 rounded-lg font-bold text-sm hidden flex items-center gap-2 whitespace-nowrap" data-product-id="{{ $producto->id }}">
                                        <i class="fa-solid fa-check-circle"></i> Aplicar
                                    </button>
                                    <a href="{{ route('catalogo.show', $producto->id) }}" class="view-product-btn bg-jm-black text-white w-10 h-10 rounded-full flex items-center justify-center hover:bg-jm-orange transition-all duration-300 transform hover:scale-110">
                                        <i class="fa-solid fa-arrow-right text-sm"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $animationDelay += 0.1; @endphp
                @empty
                    <div class="col-span-full text-center py-16">
                        <i class="fa-solid fa-box-open text-6xl text-gray-200 mb-4"></i>
                        <p class="text-gray-500 text-lg font-medium">No hay productos disponibles en esta categoría.</p>
                        <a href="{{ route('catalogo.index') }}" class="inline-block mt-6 px-6 py-3 bg-jm-orange text-white font-bold rounded-xl hover:bg-jm-orange/90 transition-all">
                            Ver todos los productos
                        </a>
                    </div>
                @endforelse

            </div>

            <!-- Pagination -->
            @if($productos->hasPages())
            <div class="mt-12 flex justify-center">
                {{ $productos->links('pagination::tailwind') }}
            </div>
            @endif
        </section>
    </main>

<!-- JavaScript para Detectar Diseño Guardado -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtener diseño del sessionStorage
    const customDesign = sessionStorage.getItem('customDesign');
    
    if (customDesign) {
        try {
            const design = JSON.parse(customDesign);
            
            // Mostrar banner de diseño cargado
            const designSection = document.getElementById('designLoadedSection');
            const previewImage = document.getElementById('designPreviewImage');
            
            if (designSection && previewImage) {
                designSection.style.display = 'block';
                // Mostrar la imagen del diseño (canvas render)
                previewImage.src = design.designImage;
            }
            
            // Mostrar botones "Aplicar Diseño" en las tarjetas de productos
            const designCards = document.querySelectorAll('.apply-design-card');
            const applyBtns = document.querySelectorAll('.apply-design-card-btn');
            const viewBtns = document.querySelectorAll('.view-product-btn');
            
            designCards.forEach(card => {
                card.classList.add('product-with-design');
            });
            
            applyBtns.forEach(btn => {
                btn.style.display = 'inline-flex';
                btn.classList.add('items-center', 'gap-2');
                btn.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    applyDesignToProduct(productId, design);
                });
            });
            
            // Ocultar los botones de "Ver" cuando hay un diseño cargado
            viewBtns.forEach(btn => {
                btn.style.display = 'none';
            });
            
        } catch (e) {
            console.error('Error al procesar diseño guardado:', e);
        }
    }
    
    // Limpiar diseño guardado
    const clearBtn = document.getElementById('clearDesignBtn');
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            sessionStorage.removeItem('customDesign');
            location.reload();
        });
    }
});

// Función para aplicar diseño a un producto
function applyDesignToProduct(productId, design) {
    // Crear objeto con datos del producto + diseño
    const cartItem = {
        product_id: productId,
        design: {
            designImage: design.designImage,
            uploadedImage: design.uploadedImage,
            mugColor: design.mugColor,
            timestamp: design.timestamp
        }
    };
    
    // Guardar en sessionStorage con una clave única
    sessionStorage.setItem('designedProduct_' + productId, JSON.stringify(cartItem));
    
    // Redirigir a la vista de detalle del producto
    window.location.href = `/catalogo/${productId}`;
}
</script>

@endsection
