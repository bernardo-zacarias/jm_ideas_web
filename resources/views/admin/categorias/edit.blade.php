@extends('admin.layout')

@section('title', 'Editar Categoría')
@section('header', 'Editar Categoría')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white px-6 py-4">
            <h3 class="text-lg font-semibold">Editar Categoría</h3>
        </div>

        <form action="{{ route('admin.categorias.update', $categoria) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div>
                <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nombre de la Categoría <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('nombre') border-red-500 @enderror"
                    placeholder="Ej: Tazas, Chapitas, Calendarios..." required>
                @error('nombre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Descripción -->
            <div>
                <label for="descripcion" class="block text-sm font-semibold text-gray-700 mb-2">
                    Descripción
                </label>
                <textarea id="descripcion" name="descripcion" rows="4"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    placeholder="Describe brevemente esta categoría...">{{ old('descripcion', $categoria->descripcion) }}</textarea>
            </div>

            <!-- Botones -->
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors font-semibold">
                    <i class="fas fa-save mr-2"></i>Actualizar Categoría
                </button>
                <a href="{{ route('admin.categorias.index') }}" class="flex-1 px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold text-center">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
