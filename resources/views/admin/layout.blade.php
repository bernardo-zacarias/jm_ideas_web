<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Administrador - JM Ideas')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-gray-100">

    <!-- Sidebar -->
    <div class="flex h-screen bg-gray-900">
        <div class="w-64 bg-gray-800 text-white p-6 shadow-lg overflow-y-auto">
            <!-- Logo -->
            <div class="flex items-center gap-2 mb-10">
                <div class="w-10 h-10 bg-orange-500 rounded-lg flex items-center justify-center text-white font-black">JM</div>
                <span class="font-black text-xl">ADMIN</span>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-orange-500' : 'hover:bg-gray-700' }} transition-colors">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Dashboard</span>
                </a>

                <!-- Productos -->
                <div>
                    <button onclick="toggleMenu('productos')" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-box w-5"></i>
                        <span>Productos</span>
                        <i class="fas fa-chevron-down ml-auto"></i>
                    </button>
                    <div id="productos" class="hidden ml-4 mt-2 space-y-1">
                        <a href="{{ route('admin.productos.index') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.productos.*') ? 'bg-orange-500' : 'hover:bg-gray-700' }} transition-colors text-sm">
                            <i class="fas fa-list w-4 mr-2"></i>Listar Productos
                        </a>
                        <a href="{{ route('admin.productos.create') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm">
                            <i class="fas fa-plus w-4 mr-2"></i>Crear Producto
                        </a>
                    </div>
                </div>

                <!-- Categorías -->
                <div>
                    <button onclick="toggleMenu('categorias')" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-tags w-5"></i>
                        <span>Categorías</span>
                        <i class="fas fa-chevron-down ml-auto"></i>
                    </button>
                    <div id="categorias" class="hidden ml-4 mt-2 space-y-1">
                        <a href="{{ route('admin.categorias.index') }}" class="block px-4 py-2 rounded-lg {{ request()->routeIs('admin.categorias.*') ? 'bg-orange-500' : 'hover:bg-gray-700' }} transition-colors text-sm">
                            <i class="fas fa-list w-4 mr-2"></i>Listar Categorías
                        </a>
                        <a href="{{ route('admin.categorias.create') }}" class="block px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors text-sm">
                            <i class="fas fa-plus w-4 mr-2"></i>Crear Categoría
                        </a>
                    </div>
                </div>

                <!-- Cotizaciones -->
                <a href="{{ route('admin.cotizaciones.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.cotizaciones.*') ? 'bg-orange-500' : 'hover:bg-gray-700' }} transition-colors">
                    <i class="fas fa-file-contract w-5"></i>
                    <span>Cotizaciones</span>
                </a>

                <!-- Pedidos -->
                <a href="{{ route('admin.pedidos.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.pedidos.*') ? 'bg-orange-500' : 'hover:bg-gray-700' }} transition-colors">
                    <i class="fas fa-shopping-cart w-5"></i>
                    <span>Pedidos</span>
                </a>

                <hr class="border-gray-700 my-4">

                <!-- Salir -->
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-600 transition-colors text-red-400 hover:text-white">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Cerrar Sesión</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="bg-white shadow-sm border-b border-gray-200 px-8 py-4 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">@yield('header', 'Panel Administrativo')</h1>
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" class="text-gray-600 hover:text-orange-500 transition-colors" title="Ver sitio">
                        <i class="fas fa-globe w-5"></i>
                    </a>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">Administrador</p>
                    </div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto p-8">
                <!-- Mensajes de sesión -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center gap-3">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center gap-3">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script>
        function toggleMenu(id) {
            const menu = document.getElementById(id);
            menu.classList.toggle('hidden');
        }

        // Mostrar menús abiertos según la ruta actual
        document.addEventListener('DOMContentLoaded', function() {
            @if(request()->routeIs('admin.productos.*'))
                document.getElementById('productos').classList.remove('hidden');
            @elseif(request()->routeIs('admin.categorias.*'))
                document.getElementById('categorias').classList.remove('hidden');
            @endif
        });
    </script>

    @yield('scripts')
</body>
</html>
