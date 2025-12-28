@extends('layouts.app')

@section('title', 'Impresiones Digitales y Regalos Personalizados')

@section('content')

<!-- Hero Section con Imagen de Fondo -->
<header class="relative w-full overflow-hidden flex items-center justify-center hero-header" style="height: 700px;">
    <!-- Imagen de Fondo -->
    <img src="{{ asset('images/hero/hero-bg.png') }}" alt="Hero Background" class="absolute inset-0 w-full h-full object-contain object-center -z-10 opacity-70" style="background-color: #f97316;">
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/30 -z-10"></div>

    <div class="max-w-7xl mx-auto px-6 text-center relative z-10 py-20">
        <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold text-white leading-tight mb-6 hero-title text-stroke" style="letter-spacing: -0.02em; font-weight: 700;">
            IMPRESIONES QUE <br> <span class="dan-vida-text">DAN VIDA</span> A TUS IDEAS
        </h1>
        <p class="text-white/90 text-lg md:text-xl max-w-2xl mx-auto mb-10 hero-subtitle text-stroke-sm">
            Desde chapitas personalizadas hasta poleras exclusivas. Calidad digital premium para tus momentos más especiales.
        </p>
        <div class="flex flex-wrap justify-center gap-4 hero-buttons">
            <a href="{{ route('catalogo.index') }}" class="bg-jm-orange text-white px-8 py-4 rounded-2xl font-bold text-lg hover:shadow-lg hover:shadow-orange-200 transition-all flex items-center gap-2 transform hover:scale-105 duration-300">
                Explorar Catálogo <i class="fa-solid fa-arrow-right"></i>
            </a>
            <button class="bg-white border-2 border-white text-jm-black px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-50 transition-all transform hover:scale-105 duration-300">
                Ver Promociones
            </button>
        </div>
    </div>
</header>

<style>
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
    .hero-header {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        width: 100%;
        max-width: 100%;
    }
    
    .hero-header img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        object-position: center;
        max-width: 100%;
    }

    /* Animación de entrada para el título */
    .hero-title {
        animation: slide-up 0.8s ease-out;
    }

    /* Animación de entrada para el subtítulo */
    .hero-subtitle {
        animation: fade-in 1s ease-out 0.2s both;
    }

    /* Animación de entrada para los botones */
    .hero-buttons {
        animation: fade-in 1s ease-out 0.4s both;
    }

    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fade-in {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Efecto brillo en el texto destacado */
    .reveal-text {
        background: linear-gradient(90deg, #f97316, #f97316);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: color-shift 4s ease-in-out infinite;
    }

    /* Estilo para DAN VIDA */
    .dan-vida-text {
        color: #f97316;
        font-weight: 900;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }

    @keyframes color-shift {
        0%, 100% {
            filter: brightness(1);
        }
        50% {
            filter: brightness(1.2);
        }
    }

    /* Efecto hover mejorado en botones */
    button {
        position: relative;
        overflow: hidden;
    }

    button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.3);
        transition: left 0.3s ease;
    }

    button:hover::before {
        left: 100%;
    }
</style>

<!-- Bento Grid Categories -->
<section class="max-w-7xl mx-auto px-6 pt-20 pb-24">
    <div class="bento-grid">
        
        <!-- Item 1: Tazas (Grande) -->
        <div class="bento-item col-span-2 bg-yellow-400 group">
            <a href="{{ route('catalogo.index') . '?category=7' }}" class="absolute inset-0 p-8 flex flex-col justify-between">
                <div>
                    <span class="bg-black text-white text-xs font-bold px-3 py-1 rounded-full uppercase">Lo más vendido</span>
                    <h3 class="text-4xl font-black mt-4">TAZAS <br>ÚNICAS</h3>
                </div>
                <p class="font-bold underline decoration-2 underline-offset-4">Personalizar ahora →</p>
            </a>
            <!-- Icono representativo -->
            <i class="fa-solid fa-mug-hot absolute -bottom-10 -right-10 text-[180px] text-black/10 group-hover:rotate-12 transition-transform"></i>
        </div>

        <!-- Item 2: Chapitas (Pequeño) -->
        <div class="bento-item bg-cyan-400 group">
            <a href="{{ route('catalogo.index') . '?category=5' }}" class="absolute inset-0 p-8 flex flex-col justify-between">
                <h3 class="text-2xl font-black text-white">CHAPITAS <br>& PINS</h3>
                <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-cyan-600 shadow-sm">
                    <i class="fa-solid fa-circle-dot"></i>
                </div>
            </a>
        </div>

        <!-- Item 3: Calendarios (Pequeño) -->
        <div class="bento-item bg-jm-black group text-white">
            <a href="{{ route('catalogo.index') . '?category=1' }}" class="absolute inset-0 p-8 flex flex-col justify-between">
                <h3 class="text-2xl font-black">CALENDARIOS <br>2025</h3>
                <span class="text-jm-orange font-bold">Reserva el tuyo</span>
            </a>
            <i class="fa-solid fa-calendar-days absolute bottom-4 right-4 text-white/20 text-4xl"></i>
        </div>

        <!-- Item 4: Poleras (Largo) -->
        <div class="bento-item col-span-1 bg-magenta-500 group" style="background-color: #e91e63;">
            <a href="{{ route('catalogo.index') . '?category=8' }}" class="absolute inset-0 p-8 flex flex-col justify-between text-white">
                <h3 class="text-2xl font-black uppercase tracking-tighter">Textil & <br>Poleras</h3>
                <i class="fa-solid fa-shirt text-6xl"></i>
            </a>
        </div>

        <!-- Item 5: Gorros (Largo) -->
        <div class="bento-item col-span-2 bg-jm-orange group text-white">
            <div class="absolute inset-0 p-8 flex flex-col md:flex-row items-center justify-between">
                <div>
                    <h3 class="text-4xl font-black uppercase">Gorros <br>Trucker</h3>
                    <p class="mt-2 text-white/80">Estilo y personalización en cada bordado.</p>
                </div>
                <a href="{{ route('catalogo.index') . '?category=9' }}" class="mt-4 md:mt-0 bg-white text-jm-orange px-6 py-3 rounded-xl font-black hover:scale-105 transition-transform">
                    DISEÑAR
                </a>
            </div>
        </div>

        <!-- Item 6: Regalos Varios -->
        <div class="bento-item bg-lime-400">
            <a href="{{ route('catalogo.index') . '?category=4' }}" class="absolute inset-0 p-8 flex flex-col justify-center items-center text-center">
                <i class="fa-solid fa-gift text-4xl mb-2"></i>
                <h3 class="text-xl font-black">REGALOS <br>CORPORATIVOS</h3>
            </a>
        </div>
    </div>
</section>

@endsection
