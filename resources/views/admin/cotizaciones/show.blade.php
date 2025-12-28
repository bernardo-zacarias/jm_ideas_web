@extends('admin.layout')

@section('title', 'Ver Cotización')
@section('header', 'Detalles de Cotización #' . $cotizacion->id)

@section('content')

<div class="grid grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-gray-600 text-sm font-semibold mb-2">ID</p>
        <p class="text-2xl font-bold text-gray-800">#{{ $cotizacion->id }}</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-gray-600 text-sm font-semibold mb-2">Tipo de Producto</p>
        <p class="text-xl font-bold text-gray-800">{{ ucfirst($cotizacion->tipo_producto) }}</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-gray-600 text-sm font-semibold mb-2">Estado</p>
        <span class="px-4 py-2 rounded-full text-white font-semibold
            @if($cotizacion->estado === 'pendiente') bg-yellow-500
            @elseif($cotizacion->estado === 'revisado') bg-blue-500
            @elseif($cotizacion->estado === 'aprobado') bg-green-500
            @else bg-red-500
            @endif">
            {{ ucfirst($cotizacion->estado) }}
        </span>
    </div>
</div>

<div class="grid grid-cols-2 gap-6 mb-6">
    <!-- Información General -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Información General</h3>
        <div class="space-y-3">
            <div>
                <p class="text-gray-600 text-sm font-semibold">Cliente</p>
                <p class="text-gray-800">{{ $cotizacion->usuario->name ?? 'Cliente Anónimo' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-semibold">Email</p>
                <p class="text-gray-800">{{ $cotizacion->usuario->email ?? 'No registrado' }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-semibold">Fecha de Creación</p>
                <p class="text-gray-800">{{ $cotizacion->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <p class="text-gray-600 text-sm font-semibold">Color Producto</p>
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 rounded-lg border-2 border-gray-300" style="background-color: {{ $cotizacion->color_producto }}"></div>
                    <p class="text-gray-800 font-mono">{{ $cotizacion->color_producto }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Descripción -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Descripción y Notas</h3>
        <div class="space-y-3">
            <div>
                <p class="text-gray-600 text-sm font-semibold mb-2">Descripción</p>
                <p class="text-gray-800 bg-gray-50 p-3 rounded-lg">{{ $cotizacion->descripcion }}</p>
            </div>
            @if($cotizacion->notas)
                <div>
                    <p class="text-gray-600 text-sm font-semibold mb-2">Notas Adicionales</p>
                    <p class="text-gray-800 bg-gray-50 p-3 rounded-lg text-sm">{{ $cotizacion->notas }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Imagen del Diseño -->
@if($cotizacion->imagen_diseño)
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Imagen del Diseño</h3>
        <img src="{{ $cotizacion->imagen_diseño }}" alt="Diseño" class="max-w-full h-auto rounded-lg border border-gray-300 max-h-96 mx-auto">
    </div>
@endif

<!-- Cambiar Estado -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Cambiar Estado</h3>
    <form action="{{ route('admin.cotizaciones.updateEstado', $cotizacion) }}" method="POST" class="flex gap-4">
        @csrf
        <select name="estado" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            <option value="pendiente" {{ $cotizacion->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="revisado" {{ $cotizacion->estado === 'revisado' ? 'selected' : '' }}>Revisado</option>
            <option value="aprobado" {{ $cotizacion->estado === 'aprobado' ? 'selected' : '' }}>Aprobado</option>
            <option value="rechazado" {{ $cotizacion->estado === 'rechazado' ? 'selected' : '' }}>Rechazado</option>
        </select>
        <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors font-semibold">
            <i class="fas fa-save mr-2"></i>Actualizar
        </button>
    </form>
</div>

<!-- Botones de Acción -->
<div class="flex gap-4">
    <a href="{{ route('admin.cotizaciones.index') }}" class="flex-1 px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold text-center">
        <i class="fas fa-arrow-left mr-2"></i>Volver
    </a>
    <form action="{{ route('admin.cotizaciones.destroy', $cotizacion) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta cotización?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-semibold">
            <i class="fas fa-trash mr-2"></i>Eliminar
        </button>
    </form>
</div>

@endsection
