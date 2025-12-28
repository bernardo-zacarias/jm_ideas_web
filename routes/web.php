<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CatalogoController; 
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransbankController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- 1. Rutas de Autenticación
// =======================================================
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('login.submit');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

// Logout
Route::post('logout', function() {
    Auth::logout();
    return redirect('/');
})->name('logout');

// --- 2. Rutas Públicas (Catálogo y Página Estática)
// =======================================================
// Listado de Productos (Catálogo)
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');

// Búsqueda de Productos
Route::get('/buscar', [CatalogoController::class, 'buscar'])->name('catalogo.buscar');

// Vista de Producto Individual
Route::get('/catalogo/{producto}', [CatalogoController::class, 'show'])->name('catalogo.show');

// Página Nosotros
Route::get('/nosotros', function () {
    return view('nosotros.index');
})->name('nosotros.index');

// Página Contacto
Route::get('/contacto', function () {
    return view('contacto.index');
})->name('contacto.index');

// Diseñador de Tazas 3D
Route::get('/designer/tazas', function () {
    return view('catalogo.designer-tazas');
})->name('designer.tazas');

// --- 3. Rutas de Carrito (Públicas - sin autenticación requerida)
// =======================================================
Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::delete('/carrito/{item}', [CarritoController::class, 'destroy'])->name('carrito.destroy');

// Checkout público para invitados
Route::get('/checkout/guest', [CheckoutController::class, 'indexPublic'])->name('checkout.public.index');
Route::post('/checkout/guest', [CheckoutController::class, 'storeGuest'])->name('checkout.guest.store');

// Ver estado de pedido (público)
Route::get('/pedidos/{pedido}/estado', [PedidoController::class, 'showPublic'])->name('pedidos.show.public');

// Transbank
Route::get('/pagar/{pedido}', [TransbankController::class, 'iniciarPago'])->name('transbank.iniciar');
Route::post('/transbank/callback', [TransbankController::class, 'callback'])->name('transbank.callback');
Route::get('/transbank/callback', [TransbankController::class, 'callback'])->name('transbank.callback.get');

// --- 4. Rutas Admin (Protegidas con Middleware de Admin)
// ========================================================
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Categorías
    Route::get('/categorias', [AdminController::class, 'indexCategorias'])->name('categorias.index');
    Route::get('/categorias/create', [AdminController::class, 'createCategoria'])->name('categorias.create');
    Route::post('/categorias', [AdminController::class, 'storeCategoria'])->name('categorias.store');
    Route::get('/categorias/{categoria}/edit', [AdminController::class, 'editCategoria'])->name('categorias.edit');
    Route::put('/categorias/{categoria}', [AdminController::class, 'updateCategoria'])->name('categorias.update');
    Route::delete('/categorias/{categoria}', [AdminController::class, 'destroyCategoria'])->name('categorias.destroy');
    
    // Productos
    Route::get('/productos', [AdminController::class, 'indexProductos'])->name('productos.index');
    Route::get('/productos/create', [AdminController::class, 'createProducto'])->name('productos.create');
    Route::post('/productos', [AdminController::class, 'storeProducto'])->name('productos.store');
    Route::get('/productos/{producto}/edit', [AdminController::class, 'editProducto'])->name('productos.edit');
    Route::put('/productos/{producto}', [AdminController::class, 'updateProducto'])->name('productos.update');
    Route::delete('/productos/{producto}', [AdminController::class, 'destroyProducto'])->name('productos.destroy');
    
    // Pedidos
    Route::get('/pedidos', [AdminController::class, 'indexPedidos'])->name('pedidos.index');
    Route::get('/pedidos/{pedido}', [AdminController::class, 'showPedido'])->name('pedidos.show');
    Route::post('/pedidos/{pedido}/estado', [AdminController::class, 'updateEstadoPedido'])->name('pedidos.updateEstado');
    Route::delete('/pedidos/{pedido}', [AdminController::class, 'destroyPedido'])->name('pedidos.destroy');
});

// --- 6. Ruta por Defecto (Welcome/Home)
// =======================================================
Route::get('/', function () {
    return view('welcome');
});