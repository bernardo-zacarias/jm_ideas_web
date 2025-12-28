# 🧹 PLAN DE LIMPIEZA PASO A PASO

## Orden de Eliminación Recomendado

### PASO 1: Eliminar Rutas (routes/web.php)

Eliminar estas líneas/bloques:

```php
// ELIMINAR: Cotizador
Route::post('/catalogo/save-cotizacion', ...);
Route::get('/cotizador', ...);
Route::post('/cotizador', ...);

// ELIMINAR: Home para clientes
Route::get('/home', function () { ... })->name('home');

// ELIMINAR: Perfil
Route::get('/perfil/editar', ...);
Route::put('/perfil', ...);

// ELIMINAR: Password Reset
Route::get('forgot-password', ...);
Route::post('forgot-password', ...);
Route::get('reset-password/{token}', ...);
Route::post('reset-password', ...);

// ELIMINAR: Checkout para clientes auth
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// ELIMINAR: Pedidos para clientes auth
Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos.index');
Route::get('/pedidos/{pedido}', [PedidoController::class, 'show'])->name('pedidos.show');
```

---

### PASO 2: Eliminar Archivos de Vistas

```bash
# Cotizador
rm resources/views/cotizador/cotizador.blade.php
rm -rf resources/views/cotizador/  # Si la carpeta queda vacía

# Home clientes
rm resources/views/home.blade.php

# Perfil
rm resources/views/profile/edit.blade.php
rm -rf resources/views/profile/  # Si la carpeta queda vacía

# Password Reset
rm resources/views/auth/forgot-password.blade.php
rm resources/views/auth/reset-password.blade.php

# Pedidos (clientes auth)
rm resources/views/pedidos/index.blade.php
rm resources/views/pedidos/show.blade.php
rm -rf resources/views/pedidos/  # Si la carpeta queda vacía
```

---

### PASO 3: Eliminar Controladores

```bash
rm app/Http/Controllers/CotizadorController.php
rm app/Http/Controllers/ProfileController.php
```

---

### PASO 4: Limpiar AdminController.php

En `app/Http/Controllers/AdminController.php`, eliminar estos métodos:

```php
// ELIMINAR estos métodos:
- indexCotizaciones()
- showCotizacion()
- updateEstadoCotizacion()
- destroyCotizacion()
```

---

### PASO 5: Limpiar PedidoController.php

En `app/Http/Controllers/PedidoController.php`, eliminar estos métodos:

```php
// ELIMINAR estos métodos:
- index()     // para clientes auth
- show()      // para clientes auth

// MANTENER:
- showPublic()  // para guests
```

---

### PASO 6: Limpiar CheckoutController.php

En `app/Http/Controllers/CheckoutController.php`, eliminar estos métodos:

```php
// ELIMINAR estos métodos:
- index()     // para clientes auth
- store()     // para clientes auth

// MANTENER:
- indexPublic()   // para guests
- storeGuest()    // para guests
```

---

### PASO 7: Eliminar Vistas Admin Cotizaciones

```bash
rm resources/views/admin/cotizaciones/index.blade.php
rm resources/views/admin/cotizaciones/show.blade.php
rm -rf resources/views/admin/cotizaciones/  # Si la carpeta queda vacía
```

---

### PASO 8: Eliminar Modelos

```bash
rm app/Models/Cotizacion.php
```

---

### PASO 9: Limpiar Imports en Controladores

Si en `AdminController.php` importa `Cotizacion`, eliminar:
```php
use App\Models\Cotizacion;
```

---

### PASO 10: Limpiar Imports en routes/web.php

Si en `routes/web.php` importa `CotizadorController`, eliminar:
```php
use App\Http\Controllers\CotizadorController;
use App\Http\Controllers\ProfileController;
```

---

## Verificación Final

Después de eliminar, ejecutar:

```bash
# Limpiar cache de Laravel
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Verificar que no haya errores
php artisan route:list | grep -E "cotizar|home|perfil|pedidos|checkout"
# Debería retornar vacío (excepto admin/pedidos y pedidos/{id}/estado)

# Iniciar servidor
php artisan serve
```

---

## Checklist de Eliminación

- [ ] Rutas eliminadas de routes/web.php
- [ ] Vista home.blade.php eliminada
- [ ] Vista cotizador/cotizador.blade.php eliminada
- [ ] Vista profile/edit.blade.php eliminada
- [ ] Vistas auth password reset eliminadas
- [ ] Vistas pedidos (clientes) eliminadas
- [ ] Vistas admin cotizaciones eliminadas
- [ ] Controlador CotizadorController eliminado
- [ ] Controlador ProfileController eliminado
- [ ] Métodos de AdminController limpios
- [ ] Métodos de PedidoController limpios
- [ ] Métodos de CheckoutController limpios
- [ ] Modelo Cotizacion.php eliminado
- [ ] Imports limpios (sin referencias a eliminados)
- [ ] Cache limpiado
- [ ] Servidor prueba sin errores

---

## Archivos Finales que Quedarán

### Controllers (8):
✅ AdminController.php (limpio)
✅ CatalogoController.php
✅ CarritoController.php
✅ CheckoutController.php (limpio)
✅ TransbankController.php
✅ PedidoController.php (limpio)
✅ LoginController.php
✅ RegisterController.php
✅ PasswordResetController.php

### Models (7):
✅ User.php
✅ Producto.php
✅ Categoria.php
✅ Pedido.php
✅ ItemPedido.php
✅ Carrito.php
✅ ItemCarrito.php

### Views (20+):
✅ welcome.blade.php
✅ catalogo/index.blade.php
✅ catalogo/show.blade.php
✅ catalogo/designer-tazas.blade.php
✅ carrito/carrito.blade.php
✅ checkout/guest.blade.php
✅ transbank/redirect.blade.php
✅ admin/dashboard.blade.php
✅ admin/categorias/* (3 vistas)
✅ admin/productos/* (3 vistas)
✅ admin/pedidos/* (2 vistas)
✅ auth/login.blade.php
✅ auth/register.blade.php
✅ nosotros/index.blade.php
✅ contacto/index.blade.php
✅ layouts/app.blade.php
✅ emails/* (2 vistas)
✅ transbank/redirect.blade.php

---

## Notas Importantes

1. **Backup**: Antes de empezar, haz commit de los cambios actuales
   ```bash
   git add .
   git commit -m "Backup antes de limpieza"
   ```

2. **Migraciones**: No elimines migraciones de cotizaciones (podrían existir registros)

3. **Base de datos**: La tabla `cotizaciones` seguirá existiendo en BD, pero la app no la usará

4. **Reversibilidad**: Si cometes un error, puedes revertir con git:
   ```bash
   git reset HEAD~1
   ```

5. **Testing**: Después de cada sección, prueba en el navegador que todo funcione

---

