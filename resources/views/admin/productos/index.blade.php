@extends('admin.layout')

@section('title', 'Gestionar Productos')
@section('header', 'Productos')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-gray-800">Listado de Productos</h2>
    <a href="{{ route('admin.productos.create') }}" class="flex items-center gap-2 px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors font-semibold">
        <i class="fas fa-plus"></i>
        Nuevo Producto
    </a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Imagen</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Nombre</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Categoría</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Precio</th>
                <th class="px-6 py-4 text-center text-gray-700 font-semibold">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($productos as $producto)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        @if($producto->imagen)
                            <img src="{{ asset('images/productos/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="h-12 w-12 object-cover rounded-lg">
                        @else
                            <div class="h-12 w-12 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">{{ $producto->nombre }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">${{ number_format($producto->precio, 0, ',', '.') }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('admin.productos.edit', $producto) }}" class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm font-semibold">
                            <i class="fas fa-edit"></i>
                            Editar
                        </a>
                        <form action="{{ route('admin.productos.destroy', $producto) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-2 px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors text-sm font-semibold">
                                <i class="fas fa-trash"></i>
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl opacity-20 mb-4 block"></i>
                        No hay productos registrados
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación -->
<div class="mt-6">
    {{ $productos->links('pagination::tailwind') }}
</div>

@endsection
