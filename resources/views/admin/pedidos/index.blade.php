@extends('admin.layout')

@section('title', 'Gestionar Pedidos')
@section('header', 'Pedidos')

@section('content')

<div class="grid grid-cols-5 gap-4 mb-6">
    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
        <p class="text-gray-600 text-sm font-semibold">Total</p>
        <p class="text-2xl font-bold text-gray-800">{{ $pedidos->total() }}</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-yellow-500">
        <p class="text-gray-600 text-sm font-semibold">Pendientes</p>
        <p class="text-2xl font-bold text-yellow-600">{{ $pedidos->where('estado', 'pendiente')->count() }}</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
        <p class="text-gray-600 text-sm font-semibold">Procesando</p>
        <p class="text-2xl font-bold text-blue-600">{{ $pedidos->where('estado', 'procesando')->count() }}</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-purple-500">
        <p class="text-gray-600 text-sm font-semibold">Enviados</p>
        <p class="text-2xl font-bold text-purple-600">{{ $pedidos->where('estado', 'enviado')->count() }}</p>
    </div>
    <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-green-500">
        <p class="text-gray-600 text-sm font-semibold">Entregados</p>
        <p class="text-2xl font-bold text-green-600">{{ $pedidos->where('estado', 'entregado')->count() }}</p>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100 border-b border-gray-200">
            <tr>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">#ID</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Cliente</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">Total</th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">
                    <div class="flex items-center gap-2">
                        Estado
                        <select id="filtroEstado" class="text-xs px-2 py-1 border border-gray-300 rounded bg-white hover:bg-gray-50 cursor-pointer" onchange="aplicarFiltros()">
                            <option value="">Todos</option>
                            <option value="pendiente" @if($estadoActual === 'pendiente') selected @endif>Pendiente</option>
                            <option value="procesando" @if($estadoActual === 'procesando') selected @endif>Procesando</option>
                            <option value="enviado" @if($estadoActual === 'enviado') selected @endif>Enviado</option>
                            <option value="entregado" @if($estadoActual === 'entregado') selected @endif>Entregado</option>
                            <option value="cancelado" @if($estadoActual === 'cancelado') selected @endif>Cancelado</option>
                            <option value="pagado" @if($estadoActual === 'pagado') selected @endif>Pagado</option>
                            <option value="pendiente_pago" @if($estadoActual === 'pendiente_pago') selected @endif>Pendiente Pago</option>
                            <option value="pago_rechazado" @if($estadoActual === 'pago_rechazado') selected @endif>Pago Rechazado</option>
                        </select>
                    </div>
                </th>
                <th class="px-6 py-4 text-left text-gray-700 font-semibold">
                    <div class="flex items-center gap-2">
                        Fecha
                        <div class="flex gap-1">
                            <button onclick="ordenarFecha('desc')" class="px-2 py-1 rounded @if($fechaActual === 'desc') bg-blue-500 text-white @else bg-gray-200 hover:bg-gray-300 @endif transition-colors" title="Más nuevos">
                                <i class="fas fa-arrow-down text-xs"></i>
                            </button>
                            <button onclick="ordenarFecha('asc')" class="px-2 py-1 rounded @if($fechaActual === 'asc') bg-blue-500 text-white @else bg-gray-200 hover:bg-gray-300 @endif transition-colors" title="Más antiguos">
                                <i class="fas fa-arrow-up text-xs"></i>
                            </button>
                        </div>
                    </div>
                </th>
                <th class="px-6 py-4 text-center text-gray-700 font-semibold">Acciones</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @forelse($pedidos as $pedido)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-gray-800 font-semibold">#{{ $pedido->id }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $pedido->usuario->name ?? 'Cliente Anónimo' }}</td>
                    <td class="px-6 py-4 text-gray-800 font-semibold">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-white text-xs font-semibold
                            @if($pedido->estado === 'pendiente' || $pedido->estado === 'pendiente_pago') bg-yellow-500
                            @elseif($pedido->estado === 'procesando') bg-blue-500
                            @elseif($pedido->estado === 'enviado') bg-purple-500
                            @elseif($pedido->estado === 'entregado') bg-green-500
                            @elseif($pedido->estado === 'pagado') bg-green-500
                            @elseif($pedido->estado === 'pago_rechazado') bg-red-500
                            @else bg-gray-500
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $pedido->estado)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                    <td class="px-6 py-4 text-center space-x-2">
                        <a href="{{ route('admin.pedidos.show', $pedido) }}" class="inline-flex items-center gap-2 px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors text-sm font-semibold">
                            <i class="fas fa-eye"></i>
                            Ver
                        </a>
                        <form action="{{ route('admin.pedidos.destroy', $pedido) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro?');">
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
                        No hay pedidos registrados
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Paginación -->
<div class="mt-6">
    {{ $pedidos->links('pagination::tailwind') }}
</div>

<script>
    /**
     * Aplicar filtros de estado y fecha
     */
    function aplicarFiltros() {
        const estado = document.getElementById('filtroEstado').value;
        const fecha = '{{ $fechaActual }}';
        const url = new URL(window.location);
        
        if (estado !== '') {
            url.searchParams.set('estado', estado);
        } else {
            url.searchParams.delete('estado');
        }
        
        // Mantener el parámetro de fecha
        url.searchParams.set('fecha', fecha);
        
        window.location.href = url.toString();
    }

    /**
     * Ordenar por fecha
     */
    function ordenarFecha(orden) {
        const estado = document.getElementById('filtroEstado').value;
        const url = new URL(window.location);
        
        url.searchParams.set('fecha', orden);
        
        if (estado !== '') {
            url.searchParams.set('estado', estado);
        } else {
            url.searchParams.delete('estado');
        }
        
        window.location.href = url.toString();
    }
</script>

@endsection
