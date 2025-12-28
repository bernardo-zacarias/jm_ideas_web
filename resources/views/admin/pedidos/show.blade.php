@extends('admin.layout')

@section('title', 'Ver Pedido')
@section('header', 'Detalles de Pedido #' . $pedido->id)

@section('content')

<div class="grid grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-gray-600 text-sm font-semibold mb-2">ID Pedido</p>
        <p class="text-2xl font-bold text-gray-800">#{{ $pedido->id }}</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-gray-600 text-sm font-semibold mb-2">Total</p>
        <p class="text-2xl font-bold text-gray-800">${{ number_format($pedido->total, 0, ',', '.') }}</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-gray-600 text-sm font-semibold mb-2">Estado</p>
        <span class="px-4 py-2 rounded-full text-white font-semibold
            @if($pedido->estado === 'pendiente') bg-yellow-500
            @elseif($pedido->estado === 'procesando') bg-blue-500
            @elseif($pedido->estado === 'enviado') bg-purple-500
            @elseif($pedido->estado === 'entregado') bg-green-500
            @else bg-red-500
            @endif">
            {{ ucfirst($pedido->estado) }}
        </span>
    </div>
    <div class="bg-white rounded-lg shadow-md p-6">
        <p class="text-gray-600 text-sm font-semibold mb-2">Fecha</p>
        <p class="text-gray-800">{{ $pedido->created_at->format('d/m/Y H:i') }}</p>
    </div>
</div>

<div class="grid grid-cols-2 gap-6 mb-6">
    <!-- Información del Cliente -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Información del Cliente</h3>
        <div class="space-y-3">
            <!-- Si es guest checkout, mostrar nombre_cliente -->
            @if(!$pedido->usuario_id)
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Nombre</p>
                    <p class="text-gray-800">{{ $pedido->nombre_cliente ?? 'No registrado' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Email</p>
                    <p class="text-gray-800">{{ $pedido->email_cliente ?? 'No registrado' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Teléfono</p>
                    <p class="text-gray-800">{{ $pedido->telefono_cliente ?? 'No registrado' }}</p>
                </div>
            <!-- Si es usuario registrado, mostrar datos del usuario -->
            @else
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Nombre</p>
                    <p class="text-gray-800">{{ $pedido->usuario->name ?? 'No registrado' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Email</p>
                    <p class="text-gray-800">{{ $pedido->usuario->email ?? 'No registrado' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Teléfono</p>
                    <p class="text-gray-800">{{ $pedido->usuario->telefono ?? 'No registrado' }}</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Información de Entrega -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Información de Entrega</h3>
        <div class="space-y-3">
            <!-- Si es guest checkout -->
            @if(!$pedido->usuario_id)
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Ciudad</p>
                    <p class="text-gray-800">No especificada</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Comuna</p>
                    <p class="text-gray-800">{{ $pedido->comuna_cliente ?? 'No especificada' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Dirección</p>
                    <p class="text-gray-800">{{ $pedido->direccion_cliente ?? 'No especificada' }}</p>
                </div>
            <!-- Si es usuario registrado -->
            @else
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Ciudad</p>
                    <p class="text-gray-800">{{ $pedido->usuario->ciudad ?? 'No especificada' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Comuna</p>
                    <p class="text-gray-800">{{ $pedido->usuario->comuna ?? 'No especificada' }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm font-semibold">Dirección</p>
                    <p class="text-gray-800">{{ $pedido->direccion_entrega ?? 'No especificada' }}</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Items del Pedido -->
<div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white px-6 py-4">
        <h3 class="text-lg font-semibold">Items del Pedido</h3>
    </div>
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Producto</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Cantidad</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Costo Total</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($items as $item)
                <tr>
                    <td class="px-6 py-4 text-gray-800 font-semibold">
                        <div>
                            <p>{{ $item->producto_nombre ?? 'Producto desconocido' }}</p>
                            @if($item->ruta_archivo)
                                @php
                                    $extension = pathinfo($item->ruta_archivo, PATHINFO_EXTENSION);
                                    $esImagen = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg']);
                                @endphp
                                <div class="mt-2">
                                    <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded">
                                        ✓ Diseño adjunto
                                    </span>
                                    @if($esImagen)
                                        <button onclick="verArchivo('{{ asset('storage/' . $item->ruta_archivo) }}', '{{ basename($item->ruta_archivo) }}')" 
                                                class="ml-2 px-2 py-1 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 text-xs font-semibold rounded transition-colors">
                                            Ver imagen
                                        </button>
                                    @endif
                                    <a href="{{ asset('storage/' . $item->ruta_archivo) }}" 
                                       download
                                       class="ml-2 px-2 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-semibold rounded transition-colors">
                                        Descargar
                                    </a>
                                </div>
                            @endif
                            @if($item->requiere_diseno && !$item->ruta_archivo)
                                <div class="mt-2">
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 text-xs font-semibold rounded">
                                        ⏳ Diseño pendiente
                                    </span>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $item->cantidad }}</td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">${{ number_format($item->costo_final, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-8 text-center text-gray-500">No hay items en este pedido</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Notas -->
@if($pedido->notas)
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Notas del Pedido</h3>
        <p class="text-gray-800 bg-gray-50 p-3 rounded-lg">{{ $pedido->notas }}</p>
    </div>
@endif

<!-- Cambiar Estado -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Cambiar Estado del Pedido</h3>
    <form action="{{ route('admin.pedidos.updateEstado', $pedido) }}" method="POST" class="flex gap-4">
        @csrf
        <select name="estado" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500">
            <option value="pendiente" {{ $pedido->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="procesando" {{ $pedido->estado === 'procesando' ? 'selected' : '' }}>Procesando</option>
            <option value="enviado" {{ $pedido->estado === 'enviado' ? 'selected' : '' }}>Enviado</option>
            <option value="entregado" {{ $pedido->estado === 'entregado' ? 'selected' : '' }}>Entregado</option>
            <option value="cancelado" {{ $pedido->estado === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
        </select>
        <button type="submit" class="px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors font-semibold">
            <i class="fas fa-save mr-2"></i>Actualizar
        </button>
    </form>
</div>

<!-- Botones de Acción -->
<div class="flex gap-4">
    <a href="{{ route('admin.pedidos.index') }}" class="flex-1 px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold text-center">
        <i class="fas fa-arrow-left mr-2"></i>Volver
    </a>
    <form action="{{ route('admin.pedidos.destroy', $pedido) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este pedido?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="w-full px-6 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors font-semibold">
            <i class="fas fa-trash mr-2"></i>Eliminar
        </button>
    </form>
</div>

<!-- Modal para ver imagen de diseño -->
<div id="modal-imagen" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg max-w-4xl max-h-96 overflow-hidden relative">
        <button onclick="cerrarModal()" class="absolute top-4 right-4 bg-red-500 hover:bg-red-600 text-white rounded-full w-10 h-10 flex items-center justify-center z-10">
            <i class="fas fa-times"></i>
        </button>
        <img id="img-modal" src="" alt="Diseño" class="w-full h-full object-contain">
    </div>
</div>

<script>
    function verArchivo(url, nombre) {
        const modal = document.getElementById('modal-imagen');
        const img = document.getElementById('img-modal');
        img.src = url;
        img.alt = nombre;
        modal.classList.remove('hidden');
    }

    function cerrarModal() {
        const modal = document.getElementById('modal-imagen');
        modal.classList.add('hidden');
    }

    // Cerrar modal al hacer clic fuera de la imagen
    document.getElementById('modal-imagen').addEventListener('click', function(e) {
        if (e.target === this) {
            cerrarModal();
        }
    });
</script>

@endsection
