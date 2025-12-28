@extends('admin.layout')

@section('title', 'Gestionar Cotizaciones')
@section('header', 'Cotizaciones de Diseños')

@section('content')

<div class="grid grid-cols-4 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
        <p class="text-gray-600 text-sm font-semibold">Total</p>
        <p class="text-2xl font-bold text-gray-800">{{ $cotizaciones->total() }}</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-yellow-500">
        <p class="text-gray-600 text-sm font-semibold">Pendientes</p>
        <p class="text-2xl font-bold text-yellow-600">{{ $cotizaciones->where('estado', 'pendiente')->count() }}</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-500">
        <p class="text-gray-600 text-sm font-semibold">Aprobadas</p>
        <p class="text-2xl font-bold text-green-600">{{ $cotizaciones->where('estado', 'aprobado')->count() }}</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-red-500">
        <p class="text-gray-600 text-sm font-semibold">Rechazadas</p>
        <p class="text-2xl font-bold text-red-600">{{ $cotizaciones->where('estado', 'rechazado')->count() }}</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">#ID</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Tipo</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Cliente</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Estado</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Fecha</th>
                <th class="px-6 py-4 text-center text-gray-700 font-semibold">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($cotizaciones as $cotizacion)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-gray-800 font-semibold">#{{ $cotizacion->id }}</td>
                    <td class="px-6 py-4 text-gray-600">
                        <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-sm font-semibold">
                            {{ ucfirst($cotizacion->tipo_producto) ?? 'General' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $cotizacion->usuario->name ?? 'Anónimo' }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-white text-xs font-semibold
                            @if($cotizacion->estado === 'pendiente') bg-yellow-500
                            @elseif($cotizacion->estado === 'revisado') bg-blue-500
                            @elseif($cotizacion->estado === 'aprobado') bg-green-500
                            @else bg-red-500
                            @endif">
                            {{ ucfirst($cotizacion->estado) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $cotizacion->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('admin.cotizaciones.show', $cotizacion) }}" class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm font-semibold">
                            <i class="fas fa-eye"></i>
                            Ver
                        </a>
                        <form action="{{ route('admin.cotizaciones.destroy', $cotizacion) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm font-semibold">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl opacity-20 mb-4 block"></i>
                        No hay cotizaciones registradas
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación -->
<div class="mt-6">
    {{ $cotizaciones->links('pagination::tailwind') }}
</div>

@endsection
