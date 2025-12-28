<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JM_Idea - @yield('title', 'Impresiones Digitales y Regalos Personalizados')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9f9f9;
        }

        .bento-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 300px);
            gap: 1.5rem;
        }

        .bento-item {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
        }

        .bento-item:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .jm-orange { color: #f97316; }
        .bg-jm-orange { background-color: #f97316; }
        .text-jm-orange { color: #f97316; }
        .border-jm-orange { border-color: #f97316; }
        .bg-jm-black { background-color: #000000; }
        .text-jm-black { color: #000000; }

        /* Estilos para móviles */
        @media (max-width: 1024px) {
            .bento-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: auto;
            }
            .bento-item { height: 250px; }
        }

        @media (max-width: 640px) {
            .bento-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Animación suave para el texto */
        .reveal-text {
            background: linear-gradient(to right, #FF6600, #ff9800);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @yield('styles')
    </style>
</head>
<body class="flex flex-col min-h-screen">

    <!-- Barra de Anuncio -->
    <div class="bg-jm-black text-white text-center py-2 text-sm font-medium tracking-wide">
        ✨ ¡Transformamos tus ideas en realidad! Envíos a todo el país ✨
    </div>

    <!-- Header / Nav -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo/jm_ideas.jpg') }}" alt="JM Ideas Logo" class="h-10 object-contain">
                    <span class="font-black text-2xl tracking-tighter text-jm-black hidden sm:inline">JM_IDEA</span>
                </a>
            </div>
            
            <div class="hidden md:flex items-center gap-8 font-semibold text-gray-600">
                <a href="{{ route('catalogo.index') }}" class="hover:text-jm-orange transition-colors">Productos</a>
                <a href="{{ route('designer.tazas') }}" class="hover:text-jm-orange transition-colors">Personalizar taza</a>
                <a href="{{ route('nosotros.index') }}" class="hover:text-jm-orange transition-colors">Nosotros</a>
                
                @if(auth()->check() && auth()->user()->rol === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="bg-orange-500 text-white px-6 py-2 rounded-full hover:bg-orange-600 transition-all font-semibold text-sm">
                        <i class="fas fa-cog mr-2"></i>Panel Admin
                    </a>
                @else
                    <a href="{{ route('contacto.index') }}" class="bg-jm-black text-white px-6 py-2 rounded-full hover:bg-jm-orange transition-all">Contacto</a>
                @endif
            </div>

            <div class="flex items-center gap-4 text-xl">
                <!-- Búsqueda de Productos -->
                <form action="{{ route('catalogo.buscar') }}" method="GET" class="flex items-center">
                    <input type="text" name="q" placeholder="Buscar productos..." 
                           class="hidden md:block px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-jm-orange focus:ring-2 focus:ring-jm-orange/30 text-sm w-48"
                           value="{{ request('q', '') }}">
                    <button type="submit" class="text-jm-orange hover:text-jm-black transition-colors">
                        <i class="fa-solid fa-magnifying-glass cursor-pointer"></i>
                    </button>
                </form>
                
                <a href="{{ route('carrito.index') }}" class="hover:text-jm-orange transition-colors" title="Carrito">
                    <i class="fa-solid fa-cart-shopping cursor-pointer"></i>
                </a>
                <button class="md:hidden cursor-pointer hover:text-jm-orange">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-jm-black text-white py-16 mt-24">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
                <!-- Logo -->
                <div class="mb-6">
                    <img src="{{ asset('images/logo/jm_ideas.jpg') }}" alt="JM Ideas Logo" class="h-24 object-contain">
                </div>
                <p class="text-gray-400">Somos especialistas en llevar tus diseños al siguiente nivel. Tecnología de punta y amor por los detalles.</p>
                <div class="flex gap-4 mt-6 text-2xl">
                    <a href="https://www.instagram.com/jmideasimpresiones/" target="_blank" class="text-white hover:text-jm-orange transition-colors">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/jmideas.impresiones.3" target="_blank" class="text-white hover:text-jm-orange transition-colors">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://wa.me/56978515292?text=Hola%20JM%20Ideas,%20me%20interesa%20conocer%20m%C3%A1s%20sobre%20vuestros%20productos" target="_blank" class="text-white hover:text-jm-orange transition-colors">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase tracking-widest text-sm">Servicios</h4>
                <ul class="text-gray-400 space-y-3">
                    <li><a href="{{ route('catalogo.index') }}" class="hover:text-white transition-colors">Impresión Digital</a></li>
                    <li><a href="{{ route('catalogo.index') }}" class="hover:text-white transition-colors">Merchandising</a></li>
                    <li><a href="{{ route('designer.tazas') }}" class="hover:text-white transition-colors">Diseño Personalizado</a></li>
                    <li><a href="{{ route('catalogo.index') }}" class="hover:text-white transition-colors">Catálogo Completo</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6 uppercase tracking-widest text-sm">Contacto</h4>
                <p class="text-gray-400 mb-4 text-sm">
                    <strong>WhatsApp:</strong> +56 9 7851 5292<br>
                    <strong>Email:</strong> info@jmideas.cl<br>
                    <strong>Ubicación:</strong> <a href="https://maps.app.goo.gl/g5GgaefqBWU4uhG7A" target="_blank" class="text-jm-orange hover:text-white transition-colors">Padre Hurtado 7358, Cerro Navia, Santiago</a>
                </p>
                <p class="text-gray-500 text-xs mt-4">Envíos a todo el país</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-zinc-800 text-center text-gray-500 text-sm">
            &copy; 2025 JM_IDEA Impresiones. Todos los derechos reservados.
        </div>
    </footer>

    <!-- Botón WhatsApp Flotante -->
    <a href="https://wa.me/56978515292?text=Hola%20JM%20Ideas,%20tengo%20una%20consulta" 
       target="_blank" 
       rel="noopener noreferrer"
       class="fixed bottom-8 right-8 w-16 h-16 bg-jm-orange hover:bg-orange-700 rounded-full flex items-center justify-center shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-110 z-40 animate-pulse"
       title="Contactar por WhatsApp">
        <i class="fa-brands fa-whatsapp text-white text-2xl"></i>
    </a>

    @stack('scripts')
</body>
</html>
