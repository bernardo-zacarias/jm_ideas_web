@extends('layouts.app')

@section('title', 'Contacto - JM Ideas Impresiones')

@section('content')

<!-- Título Simple Contacto -->
<div class="bg-white border-b border-gray-200 py-8">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text-4xl md:text-5xl font-black text-gray-800 mb-2">Contáctanos</h1>
        <p class="text-gray-600 text-lg">Estamos aquí para responder tus preguntas</p>
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

<!-- Sección Principal de Contacto -->
<section class="max-w-7xl mx-auto px-6 py-24">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Columna de Información -->
        <div class="lg:col-span-1">
            <h2 class="text-3xl font-black text-jm-black mb-12">
                Información de <span class="text-jm-orange">Contacto</span>
            </h2>

            <!-- WhatsApp -->
            <div class="mb-8 flex items-start gap-4">
                <div class="w-12 h-12 bg-jm-orange/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fa-brands fa-whatsapp text-2xl text-jm-orange"></i>
                </div>
                <div>
                    <h3 class="font-black text-jm-black mb-1">WhatsApp</h3>
                    <a href="https://wa.me/56978515292?text=Hola%20JM%20Ideas,%20tengo%20una%20consulta" target="_blank" class="text-jm-orange hover:text-jm-black transition-colors font-semibold">
                        +56 9 7851 5292
                    </a>
                    <p class="text-gray-600 text-sm mt-1">Respuesta inmediata</p>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-8 flex items-start gap-4">
                <div class="w-12 h-12 bg-jm-orange/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-envelope text-2xl text-jm-orange"></i>
                </div>
                <div>
                    <h3 class="font-black text-jm-black mb-1">Email</h3>
                    <a href="mailto:info@jmideas.cl" class="text-jm-orange hover:text-jm-black transition-colors font-semibold">
                        info@jmideas.cl
                    </a>
                    <p class="text-gray-600 text-sm mt-1">Consultas generales</p>
                </div>
            </div>

            <!-- Ubicación -->
            <div class="mb-8 flex items-start gap-4">
                <div class="w-12 h-12 bg-jm-orange/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-map-marker-alt text-2xl text-jm-orange"></i>
                </div>
                <div>
                    <h3 class="font-black text-jm-black mb-1">Ubicación</h3>
                    <p class="text-gray-600 font-semibold">Padre Hurtado 7358, Cerro Navia</p>
                    <p class="text-gray-600 text-sm mt-1">Visítanos en nuestro taller</p>
                </div>
            </div>

            <!-- Horarios -->
            <div class="mb-8 flex items-start gap-4">
                <div class="w-12 h-12 bg-jm-orange/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-clock text-2xl text-jm-orange"></i>
                </div>
                <div>
                    <h3 class="font-black text-jm-black mb-1">Horarios</h3>
                    <p class="text-gray-600 font-semibold">Lunes a Viernes</p>
                    <p class="text-gray-600 text-sm">09:00 - 18:00</p>
                    <p class="text-gray-600 font-semibold mt-2">Sábados</p>
                    <p class="text-gray-600 text-sm">10:00 - 14:00</p>
                </div>
            </div>

            <!-- Redes Sociales -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <h3 class="font-black text-jm-black mb-6">Síguenos en Redes</h3>
                <div class="flex gap-4">
                    <a href="https://www.instagram.com/jmideasimpresiones/" target="_blank" class="w-12 h-12 bg-jm-orange/10 rounded-xl flex items-center justify-center text-jm-orange hover:bg-jm-orange hover:text-white transition-all transform hover:scale-110">
                        <i class="fa-brands fa-instagram text-xl"></i>
                    </a>
                    <a href="https://www.facebook.com/jmideas.impresiones.3" target="_blank" class="w-12 h-12 bg-jm-orange/10 rounded-xl flex items-center justify-center text-jm-orange hover:bg-jm-orange hover:text-white transition-all transform hover:scale-110">
                        <i class="fa-brands fa-facebook text-xl"></i>
                    </a>
                    <a href="https://wa.me/56978515292?text=Hola%20JM%20Ideas,%20me%20interesa%20conocer%20m%C3%A1s%20sobre%20vuestros%20productos" target="_blank" class="w-12 h-12 bg-jm-orange/10 rounded-xl flex items-center justify-center text-jm-orange hover:bg-jm-orange hover:text-white transition-all transform hover:scale-110">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mapa -->
        <div class="lg:col-span-2">
            <div class="rounded-2xl overflow-hidden shadow-lg h-96 md:h-full min-h-96">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3330.5!2d-70.7015!3d-33.4175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9665b8c6c6c6c6c7%3A0x5c5c5c5c5c5c5c5c!2sPadre%20Hurtado%207358%2C%20Cerro%20Navia%2C%20Santiago!5e0!3m2!1ses-419!2scl!4v1640000000000" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Preguntas Frecuentes -->
<section class="bg-jm-black text-white py-24">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl md:text-5xl font-black text-center mb-16">
            Preguntas <span class="text-jm-orange">Frecuentes</span>
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- FAQ 1 -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all">
                <h3 class="text-xl font-black text-jm-orange mb-3 flex items-start gap-3">
                    <span class="text-2xl">Q</span>
                    ¿Cuál es el tiempo de entrega?
                </h3>
                <p class="text-gray-300">
                    Los pedidos estándar se entregan en 3-5 días hábiles. Para proyectos especiales, consultamos los tiempos directamente con el cliente.
                </p>
            </div>

            <!-- FAQ 2 -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all">
                <h3 class="text-xl font-black text-jm-orange mb-3 flex items-start gap-3">
                    <span class="text-2xl">Q</span>
                    ¿Hacen envíos a todo el país?
                </h3>
                <p class="text-gray-300">
                    Sí, realizamos envíos a toda la región metropolitana y el país. Los costos de envío dependen de la ubicación.
                </p>
            </div>

            <!-- FAQ 3 -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all">
                <h3 class="text-xl font-black text-jm-orange mb-3 flex items-start gap-3">
                    <span class="text-2xl">Q</span>
                    ¿Puedo personalizar totalmente mis productos?
                </h3>
                <p class="text-gray-300">
                    Absolutamente. Desde colores y diseños hasta materiales especiales, trabajamos contigo para crear exactamente lo que necesitas.
                </p>
            </div>

            <!-- FAQ 4 -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all">
                <h3 class="text-xl font-black text-jm-orange mb-3 flex items-start gap-3">
                    <span class="text-2xl">Q</span>
                    ¿Ofrecen descuentos por volumen?
                </h3>
                <p class="text-gray-300">
                    Sí, tenemos planes especiales para pedidos en grandes cantidades. Contáctanos directamente para cotizar.
                </p>
            </div>

            <!-- FAQ 5 -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all">
                <h3 class="text-xl font-black text-jm-orange mb-3 flex items-start gap-3">
                    <span class="text-2xl">Q</span>
                    ¿Qué formas de pago aceptan?
                </h3>
                <p class="text-gray-300">
                    Aceptamos transferencia bancaria, tarjeta de crédito, débito y pagos a través de plataformas como Webpay.
                </p>
            </div>

            <!-- FAQ 6 -->
            <div class="bg-white/5 backdrop-blur-sm border border-white/10 rounded-2xl p-8 hover:bg-white/10 transition-all">
                <h3 class="text-xl font-black text-jm-orange mb-3 flex items-start gap-3">
                    <span class="text-2xl">Q</span>
                    ¿Ofrecen garantía en los productos?
                </h3>
                <p class="text-gray-300">
                    Sí, todos nuestros productos cuentan con garantía de calidad. Si hay algún problema, nos encargamos de solucionarlo.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="max-w-4xl mx-auto px-6 py-12">
    <div class="bg-gradient-to-r from-orange-500 to-cyan-400 rounded-3xl p-12 text-center text-white shadow-2xl">
        <h2 class="text-4xl md:text-5xl font-black mb-6 text-white">
            ¿Tienes Más Preguntas?
        </h2>
        <p class="text-lg text-white opacity-90 mb-8 leading-relaxed">
            No dudes en contactarnos. Nuestro equipo está disponible para ayudarte de lunes a sábado.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/56978515292?text=Hola%20JM%20Ideas,%20tengo%20una%20consulta" target="_blank" class="inline-flex items-center gap-2 bg-white text-orange-600 px-8 py-4 rounded-2xl font-bold text-lg hover:shadow-lg transition-all transform hover:scale-105">
                <i class="fa-brands fa-whatsapp"></i>
                Enviar WhatsApp
            </a>
            <a href="mailto:info@jmideas.cl" class="inline-flex items-center gap-2 bg-white/20 border-2 border-white text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white/30 transition-all transform hover:scale-105">
                <i class="fa-solid fa-envelope"></i>
                Enviar Email
            </a>
        </div>
    </div>
</section>

@endsection
