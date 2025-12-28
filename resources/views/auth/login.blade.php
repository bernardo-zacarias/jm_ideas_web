@extends('layouts.app')

@section('title', 'Iniciar Sesión - JM Ideas')

{{-- Usamos la sección 'content' para el diseño principal --}}
@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black -mt-10">
        <div class="w-full max-w-md mx-auto p-8 bg-white rounded-3xl shadow-2xl border border-gray-100 transform transition-all duration-300 hover:shadow-3xl">
            
            <div class="text-center mb-8">
                <div class="mb-6 flex justify-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-jm-orange to-orange-500 rounded-full flex items-center justify-center shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-extrabold bg-gradient-to-r from-jm-orange to-orange-600 bg-clip-text text-transparent mb-2">JM Ideas</h1>
                <p class="text-gray-600 font-medium">Acceso a Panel Administrativo</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl mb-6 shadow-md">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <p class="font-bold text-red-800 mb-2">Error al iniciar sesión:</p>
                            <ul class="list-disc ml-5 text-red-700 space-y-1 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="space-y-6">
                @csrf

                <div class="space-y-2">
                    <label for="email" class="block text-sm font-bold text-gray-700 flex items-center gap-2">
                        <svg class="w-5 h-5 text-jm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Correo Electrónico
                    </label>
                    <input 
                        id="email" 
                        type="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required 
                        autofocus
                        class="w-full border-2 border-gray-300 rounded-xl p-3 focus:border-jm-orange focus:ring-4 focus:ring-jm-orange/20 transition-all shadow-sm"
                        placeholder="admin@mmimpresiones.com"
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <span>⚠️</span>{{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm font-bold text-gray-700 flex items-center gap-2">
                        <svg class="w-5 h-5 text-jm-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        Contraseña
                    </label>
                    <input 
                        id="password" 
                        type="password" 
                        name="password" 
                        required
                        class="w-full border-2 border-gray-300 rounded-xl p-3 focus:border-jm-orange focus:ring-4 focus:ring-jm-orange/20 transition-all shadow-sm"
                        placeholder="••••••••"
                    >
                    @error('password')
                        <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                            <span>⚠️</span>{{ $message }}
                        </p>
                    @enderror
                </div>

                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-jm-orange to-orange-500 hover:from-jm-orange/90 hover:to-orange-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-[1.02] flex items-center justify-center gap-2"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                    </svg>
                    Acceder al Panel
                </button>
            </form>
            
            <div class="mt-8 pt-6 border-t border-gray-200 space-y-4">
                <a 
                    href="{{ route('password.request') }}" 
                    class="block text-center px-4 py-2 text-jm-orange hover:text-orange-600 font-medium transition-colors hover:underline"
                >
                    ¿Olvidaste tu contraseña?
                </a>
                
                <div class="text-center text-sm text-gray-500">
                    ¿No tienes cuenta?
                    <a 
                        href="{{ route('register') }}" 
                        class="text-jm-orange hover:text-orange-600 font-semibold transition-colors hover:underline"
                    >
                        Regístrate aquí
                    </a>
                </div>
            </div>

        </div>

        <!-- Footer Info -->
        <div class="mt-12 text-center text-gray-400 text-sm max-w-md">
            <p class="mb-2">Credenciales de acceso demo:</p>
            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                <p class="font-mono text-gray-300">📧 admin@mmimpresiones.com</p>
                <p class="font-mono text-gray-300">🔒 Admin1234</p>
            </div>
        </div>
    </div>
@endsection
