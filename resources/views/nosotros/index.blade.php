@extends('layouts.app')

@section('title', 'Sobre Nosotros - JM Ideas Impresiones')

@section('content')

<!-- Título Simple Nosotros -->
<div class="bg-white border-b border-gray-200 py-8">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl md:text-5xl font-black text-gray-800 mb-2">Sobre Nosotros</h1>
        <p class="text-gray-600 text-lg">Conoce la historia detrás de JM_IDEA</p>
    </div>
</div>

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
    .hero-bg-image {
        animation: none;
    }
</style>

<!-- Sección Principal - Nuestra Historia -->
<section class="max-w-7xl mx-auto px-6 py-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Contenido de Texto -->
        <div>
            <h2 class="text-4xl md:text-5xl font-black text-jm-black mb-6">
                Nuestra <span class="text-jm-orange">Historia</span>
            </h2>
            <p class="text-gray-600 text-lg mb-4 leading-relaxed">
                JM_IDEA nació en 2019 con una visión clara: crear un espacio donde la creatividad y la tecnología se unan para transformar ideas en productos tangibles de calidad excepcional.
            </p>
            <p class="text-gray-600 text-lg mb-4 leading-relaxed">
                Comenzamos como un pequeño taller con grandes sueños, serviendo a clientes locales que confiaban en nuestra pasión por los detalles. Hoy, somos un equipo dedicado que ha impreso miles de diseños únicos para personas de toda la región.
            </p>
            <p class="text-gray-600 text-lg leading-relaxed">
                Cada proyecto es especial para nosotros. No solo imprimimos, creamos experiencias memorables a través de productos personalizados que cuentan historias.
            </p>
        </div>

        <!-- Imagen o Icono -->
        <div class="flex justify-center items-center">
            <div class="w-full aspect-square bg-gradient-to-br from-jm-orange/20 to-cyan-400/20 rounded-3xl flex items-center justify-center">
                <i class="fa-solid fa-lightbulb text-8xl text-jm-orange/40"></i>
            </div>
        </div>
    </div>
</section>

<!-- Sección Misión, Visión y Valores -->
<section class="bg-jm-black text-white py-24">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-black text-center mb-16">
            Nuestra <span class="text-jm-orange">Filosofía</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Misión -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all">
                <div class="w-16 h-16 bg-jm-orange rounded-xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-target text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-black mb-4">Misión</h3>
                <p class="text-gray-300 leading-relaxed">
                    Proporcionar soluciones de impresión personalizada de alta calidad que permitan a nuestros clientes expresar su creatividad y fortalecer su marca.
                </p>
            </div>

            <!-- Visión -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all">
                <div class="w-16 h-16 bg-jm-orange rounded-xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-eye text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-black mb-4">Visión</h3>
                <p class="text-gray-300 leading-relaxed">
                    Ser la empresa líder en impresiones personalizadas en Chile, reconocida por nuestra excelencia, innovación y compromiso con la satisfacción del cliente.
                </p>
            </div>

            <!-- Valores -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all">
                <div class="w-16 h-16 bg-jm-orange rounded-xl flex items-center justify-center mb-6">
                    <i class="fa-solid fa-heart text-2xl text-white"></i>
                </div>
                <h3 class="text-2xl font-black mb-4">Valores</h3>
                <p class="text-gray-300 leading-relaxed">
                    Calidad, honestidad, innovación, responsabilidad ambiental y pasión por convertir ideas en realidad.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Sección Por Qué Elegirnos -->
<section class="max-w-7xl mx-auto px-6 py-24">
    <h2 class="text-4xl md:text-5xl font-black text-jm-black text-center mb-16">
        ¿Por Qué Elegir <span class="text-jm-orange">JM_IDEA</span>?
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Beneficio 1 -->
        <div class="text-center">
            <div class="w-20 h-20 bg-jm-orange/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-star text-4xl text-jm-orange"></i>
            </div>
            <h3 class="text-xl font-black text-jm-black mb-3">Calidad Premium</h3>
            <p class="text-gray-600">Utilizamos tecnología de punta y materiales de primera línea para garantizar resultados impecables.</p>
        </div>

        <!-- Beneficio 2 -->
        <div class="text-center">
            <div class="w-20 h-20 bg-jm-orange/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-zap text-4xl text-jm-orange"></i>
            </div>
            <h3 class="text-xl font-black text-jm-black mb-3">Entrega Rápida</h3>
            <p class="text-gray-600">Procesamos tus pedidos con rapidez sin comprometer la calidad del acabado final.</p>
        </div>

        <!-- Beneficio 3 -->
        <div class="text-center">
            <div class="w-20 h-20 bg-jm-orange/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-palette text-4xl text-jm-orange"></i>
            </div>
            <h3 class="text-xl font-black text-jm-black mb-3">Personalización</h3>
            <p class="text-gray-600">Desde diseño 3D hasta impresión, creamos exactamente lo que imaginas con nuestro diseñador interactivo.</p>
        </div>

        <!-- Beneficio 4 -->
        <div class="text-center">
            <div class="w-20 h-20 bg-jm-orange/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fa-solid fa-headset text-4xl text-jm-orange"></i>
            </div>
            <h3 class="text-xl font-black text-jm-black mb-3">Atención al Cliente</h3>
            <p class="text-gray-600">Estamos disponibles para resolver tus dudas y asegurar tu total satisfacción en cada paso.</p>
        </div>
    </div>
</section>

<!-- Sección Estadísticas -->
<section class="bg-gradient-to-r from-jm-orange to-cyan-400 py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 text-center text-white">
            <!-- Estadística 1 -->
            <div>
                <h3 class="text-5xl md:text-6xl font-black mb-2">5+</h3>
                <p class="text-lg opacity-90">Años de Experiencia</p>
            </div>

            <!-- Estadística 2 -->
            <div>
                <h3 class="text-5xl md:text-6xl font-black mb-2">3000+</h3>
                <p class="text-lg opacity-90">Clientes Satisfechos</p>
            </div>

            <!-- Estadística 3 -->
            <div>
                <h3 class="text-5xl md:text-6xl font-black mb-2">10000+</h3>
                <p class="text-lg opacity-90">Productos Creados</p>
            </div>

            <!-- Estadística 4 -->
            <div>
                <h3 class="text-5xl md:text-6xl font-black mb-2">100%</h3>
                <p class="text-lg opacity-90">Satisfacción Garantizada</p>
            </div>
        </div>
    </div>
</section>

<!-- Sección Equipo -->
<section class="max-w-7xl mx-auto px-6 py-24">
    <h2 class="text-4xl md:text-5xl font-black text-jm-black text-center mb-16">
        Nuestro <span class="text-jm-orange">Equipo</span>
    </h2>

    <p class="text-gray-600 text-lg text-center max-w-3xl mx-auto mb-16 leading-relaxed">
        Contamos con profesionales apasionados en diseño, producción y servicio al cliente. Cada miembro del equipo aporta su expertise para garantizar que cada proyecto sea una obra maestra.
    </p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Miembro 1 -->
        <div class="text-center group">
            <div class="w-full aspect-square bg-gradient-to-br from-jm-orange/20 to-cyan-400/20 rounded-2xl flex items-center justify-center mb-6 overflow-hidden group-hover:shadow-lg transition-all">
                <i class="fa-solid fa-user text-8xl text-jm-orange/30"></i>
            </div>
            <h3 class="text-2xl font-black text-jm-black mb-2">Creatividad</h3>
            <p class="text-gray-600">Diseñadores apasionados que transforman ideas en conceptos visuales impactantes.</p>
        </div>

        <!-- Miembro 2 -->
        <div class="text-center group">
            <div class="w-full aspect-square bg-gradient-to-br from-jm-orange/20 to-cyan-400/20 rounded-2xl flex items-center justify-center mb-6 overflow-hidden group-hover:shadow-lg transition-all">
                <i class="fa-solid fa-cogs text-8xl text-jm-orange/30"></i>
            </div>
            <h3 class="text-2xl font-black text-jm-black mb-2">Producción</h3>
            <p class="text-gray-600">Técnicos especializados con dominio de equipos de impresión de última generación.</p>
        </div>

        <!-- Miembro 3 -->
        <div class="text-center group">
            <div class="w-full aspect-square bg-gradient-to-br from-jm-orange/20 to-cyan-400/20 rounded-2xl flex items-center justify-center mb-6 overflow-hidden group-hover:shadow-lg transition-all">
                <i class="fa-solid fa-handshake text-8xl text-jm-orange/30"></i>
            </div>
            <h3 class="text-2xl font-black text-jm-black mb-2">Atención</h3>
            <p class="text-gray-600">Equipo dedicado a tu satisfacción con respuestas rápidas y soluciones personalizadas.</p>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="bg-jm-black text-white py-24">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-4xl md:text-5xl font-black mb-6">
            ¿Listo para Crear Algo <span class="text-jm-orange">Increíble</span>?
        </h2>
        <p class="text-gray-300 text-xl mb-10 leading-relaxed">
            Únete a miles de clientes satisfechos que ya confían en JM_IDEA para sus proyectos personalizados.
        </p>
        <a href="{{ route('catalogo.index') }}" class="inline-flex items-center gap-2 bg-jm-orange text-white px-10 py-4 rounded-2xl font-bold text-lg hover:shadow-lg hover:shadow-orange-200 transition-all transform hover:scale-105">
            Explorar Nuestros Productos <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</section>

@endsection
