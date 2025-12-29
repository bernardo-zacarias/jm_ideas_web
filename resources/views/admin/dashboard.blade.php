@extends('admin.layout')

@section('title', 'Dashboard - Panel Administrador')
@section('header', 'Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Productos -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Total Productos</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalProductos }}</p>
            </div>
            <i class="fas fa-box text-blue-500 text-4xl opacity-20"></i>
        </div>
    </div>

    <!-- Total Categorías -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Total Categorías</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalCategorias }}</p>
            </div>
            <i class="fas fa-tags text-green-500 text-4xl opacity-20"></i>
        </div>
    </div>

    <!-- Total Pedidos -->
    <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-semibold">Total Pedidos</p>
                <p class="text-3xl font-bold text-gray-800">{{ $totalPedidos }}</p>
            </div>
            <i class="fas fa-shopping-cart text-purple-500 text-4xl opacity-20"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Pedidos Recientes -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white px-6 py-4">
            <h3 class="text-lg font-semibold">Pedidos Recientes</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">#ID</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Cliente</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Total</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Estado</th>
                        <th class="px-6 py-3 text-left text-gray-600 font-semibold">Fecha</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pedidosRecientes as $pedido)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-3 text-gray-800 font-semibold">#{{ $pedido->id }}</td>
                            <td class="px-6 py-3 text-gray-600">{{ $pedido->usuario->name ?? 'Cliente Anónimo' }}</td>
                            <td class="px-6 py-3 text-gray-800 font-semibold">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                            <td class="px-6 py-3">
                                <span class="px-3 py-1 rounded-full text-white text-xs font-semibold
                                    @if($pedido->estado === 'pendiente') bg-yellow-500
                                    @elseif($pedido->estado === 'procesando') bg-blue-500
                                    @elseif($pedido->estado === 'enviado') bg-purple-500
                                    @elseif($pedido->estado === 'entregado') bg-green-500
                                    @else bg-red-500
                                    @endif">
                                    {{ ucfirst($pedido->estado) }}
                                </span>
                            </td>
                            <td class="px-6 py-3 text-gray-600">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No hay pedidos recientes</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200 text-right">
            <a href="{{ route('admin.pedidos.index') }}" class="text-orange-500 hover:text-orange-600 font-semibold text-sm">Ver todos los pedidos →</a>
        </div>
    </div>

    <!-- Alertas -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white px-6 py-4">
            <h3 class="text-lg font-semibold">Alertas</h3>
        </div>
        <div class="p-6 space-y-4">
            <!-- Cotizaciones Pendientes -->
            <div class="p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded">
                <div class="flex items-start gap-3">
                    <i class="fas fa-exclamation-circle text-yellow-600 text-lg mt-1"></i>
                    <div class="flex-1">
                        <p class="font-semibold text-yellow-800">Cotizaciones Pendientes</p>
                        <p class="text-2xl font-bold text-yellow-700">{{ $cotizacionesPendientes }}</p>
                        <a href="{{ route('admin.cotizaciones.index') }}" class="text-yellow-600 hover:text-yellow-700 text-sm font-semibold mt-2 inline-block">
                            Revisar →
                        </a>
                    </div>
                </div>
            </div>

            <!-- Accesos Rápidos -->
            <div class="space-y-2 pt-4 border-t border-gray-200">
                <p class="text-sm font-semibold text-gray-600 mb-3">Accesos Rápidos</p>
                <a href="{{ route('admin.productos.create') }}" class="block px-4 py-2 bg-blue-50 border border-blue-200 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors text-sm font-semibold">
                    <i class="fas fa-plus mr-2"></i>Crear Producto
                </a>
                <a href="{{ route('admin.categorias.create') }}" class="block px-4 py-2 bg-green-50 border border-green-200 text-green-700 rounded-lg hover:bg-green-100 transition-colors text-sm font-semibold">
                    <i class="fas fa-plus mr-2"></i>Crear Categoría
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
