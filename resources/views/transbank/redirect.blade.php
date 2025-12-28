<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirigiendo a Transbank...</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --jm-orange: #f97316;
            --jm-black: #000000;
        }
        .bg-jm-orange { background-color: var(--jm-orange); }
        .text-jm-orange { color: var(--jm-orange); }
    </style>
</head>
<body class="bg-gradient-to-br from-jm-orange/10 via-white to-cyan-50 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-2xl p-8 text-center border-t-4 border-jm-orange">
            <!-- Logo/Icono -->
            <div class="w-20 h-20 bg-jm-orange rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>

            <!-- Mensaje -->
            <h1 class="text-3xl font-bold text-jm-black mb-4">Redirigiendo a Webpay Plus...</h1>
            <p class="text-gray-600 mb-8">Serás redirigido automáticamente al sistema de pago seguro de Transbank.</p>

            <!-- Formulario oculto -->
            <form id="transbank-form" action="{{ $url }}" method="POST">
                @csrf
                <input type="hidden" name="token_ws" value="{{ $token }}">
            </form>

            <!-- Botón manual por si falla el auto-redirect -->
            <button 
                onclick="document.getElementById('transbank-form').submit()" 
                class="px-8 py-3 bg-jm-orange text-white font-bold rounded-xl hover:bg-jm-orange/90 transition-all shadow-lg hover:shadow-xl flex items-center justify-center gap-2 mx-auto"
            >
                <i class="fa-solid fa-credit-card"></i>
                Ir a Webpay Plus
            </button>

            <p class="text-xs text-gray-500 mt-4">Si no eres redirigido automáticamente, haz clic en el botón.</p>

            <!-- Información de Seguridad -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-600 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-lock text-green-600"></i>
                    Pago 100% seguro con encriptación SSL
                </p>
            </div>

            
        </div>
    </div>

    <script>
        // Auto-submit después de 2 segundos
        setTimeout(function() {
            document.getElementById('transbank-form').submit();
        }, 2000);
    </script>
</body>
</html>
