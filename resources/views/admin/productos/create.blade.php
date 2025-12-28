@extends('admin.layout')

@section('title', 'Crear Producto')
@section('header', 'Nuevo Producto')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white px-6 py-4">
            <h3 class="text-lg font-semibold">Crear Nuevo Producto</h3>
        </div>

        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Nombre -->
            <div>
                <label for="nombre" class="block text-sm font-semibold text-gray-700 mb-2">
                    Nombre del Producto <span class="text-red-500">*</span>
                </label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('nombre') border-red-500 @enderror"
                    placeholder="Ej: Taza Personalizada Grande" required>
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
                    placeholder="Describe el producto...">{{ old('descripcion') }}</textarea>
            </div>

            <!-- Categoría -->
            <div>
                <label for="categoria_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Categoría <span class="text-red-500">*</span>
                </label>
                <select id="categoria_id" name="categoria_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('categoria_id') border-red-500 @enderror" required>
                    <option value="">-- Selecciona una categoría --</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Precio -->
            <div>
                <label for="precio" class="block text-sm font-semibold text-gray-700 mb-2">
                    Precio (CLP) <span class="text-red-500">*</span>
                </label>
                <input type="number" id="precio" name="precio" value="{{ old('precio') }}" min="0" step="1"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('precio') border-red-500 @enderror"
                    placeholder="Ej: 25000" required>
                @error('precio')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stock -->
            <div>
                <label for="stock" class="block text-sm font-semibold text-gray-700 mb-2">
                    Stock (Unidades) <span class="text-red-500">*</span>
                </label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0" step="1"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 @error('stock') border-red-500 @enderror"
                    placeholder="Ej: 100" required>
                @error('stock')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Imagen -->
            <div>
                <label for="imagen" class="block text-sm font-semibold text-gray-700 mb-2">
                    Imagen del Producto
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-orange-500 transition-colors" id="upload-area">
                    <input type="file" id="imagen" name="imagen" accept="image/*" class="hidden" onchange="handleImageSelect(event)">
                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2 block"></i>
                    <p class="text-gray-600 font-semibold">Arrastra una imagen aquí o haz clic para seleccionar</p>
                    <p class="text-gray-500 text-sm mt-1">Máximo 2MB - Formatos: JPG, PNG, GIF</p>
                    <img id="preview" class="hidden mt-4 h-32 mx-auto">
                </div>
                @error('imagen')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex gap-4 pt-4">
                <button type="submit" class="flex-1 px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition-colors font-semibold">
                    <i class="fas fa-save mr-2"></i>Crear Producto
                </button>
                <a href="{{ route('admin.productos.index') }}" class="flex-1 px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors font-semibold text-center">
                    <i class="fas fa-times mr-2"></i>Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    const uploadArea = document.getElementById('upload-area');
    const imageInput = document.getElementById('imagen');
    const preview = document.getElementById('preview');

    uploadArea.addEventListener('click', () => imageInput.click());

    uploadArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadArea.classList.add('border-orange-500', 'bg-orange-50');
    });

    uploadArea.addEventListener('dragleave', () => {
        uploadArea.classList.remove('border-orange-500', 'bg-orange-50');
    });

    uploadArea.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadArea.classList.remove('border-orange-500', 'bg-orange-50');
        imageInput.files = e.dataTransfer.files;
        handleImageSelect({ target: imageInput });
    });

    function handleImageSelect(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }
</script>

@endsection
