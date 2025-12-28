# 📊 ANÁLISIS COMPLETO DEL PROYECTO - FLUJO DE PÁGINAS

**Proyecto:** JM Ideas Web - E-commerce con Personalización  
**Fecha:** 28 de Diciembre de 2025  
**Usuarios:** Solo Admin (sin clientes autenticados por ahora)

---

## 🎯 FLUJO ACTUAL DEL PROYECTO

```
┌─────────────────────────────────────────────────────────────────────┐
│                         WELCOME / HOME                              │
│                   (Página de bienvenida)                            │
│              resources/views/welcome.blade.php                      │
│                      ✅ EN USO                                       │
└──────────────────────────┬──────────────────────────────────────────┘
                           │
                ┌──────────┴──────────┐
                │                     │
                ▼                     ▼
    ┌─────────────────────┐  ┌──────────────────────┐
    │  CATÁLOGO PRODUCTOS │  │    AUTENTICACIÓN     │
    │                     │  │                      │
    │ /catalogo           │  │ /login               │
    │ (GET)               │  │ /register            │
    │ ✅ EN USO           │  │ ✅ EN USO            │
    └────────┬────────────┘  └──────────────────────┘
             │
             │ (Usuario selecciona producto)
             │
             ▼
    ┌─────────────────────────────────┐
    │   DETALLE PRODUCTO              │
    │                                 │
    │ /catalogo/{producto}            │
    │ (GET)                           │
    │ ✅ EN USO                        │
    │                                 │
    │ Opciones:                       │
    │ • Personalizar (ir a diseñador) │
    │ • Agregar al carrito            │
    └────────┬──────────────────────┬─┘
             │                      │
             │                      │
             ▼                      ▼
    ┌─────────────────────┐  ┌─────────────────┐
    │  DISEÑADOR 3D TAZAS │  │ CARRITO DE COMP │
    │                     │  │                 │
    │ /designer/tazas     │  │ /carrito        │
    │ (GET)               │  │ ✅ EN USO       │
    │ ✅ EN USO           │  │                 │
    │                     │  │ Opciones:       │
    │ Guarda en:          │  │ • Ver items     │
    │ sessionStorage      │  │ • Proceder pago │
    │                     │  │ • Remover items │
    └────────┬────────────┘  └────────┬────────┘
             │                        │
             │ (Vuelve a catálogo)    │
             │                        │
             └────────────┬───────────┘
                          │
                          ▼
            ┌───────────────────────────────┐
            │   CHECKOUT (GUEST)            │
            │                               │
            │ /checkout/guest               │
            │ (GET/POST)                    │
            │ ✅ EN USO                      │
            │                               │
            │ Campos:                       │
            │ • Nombre, Email, Teléfono    │
            │ • Dirección, Comuna          │
            │ • Método de pago             │
            └────────────┬──────────────────┘
                         │
                         ▼
            ┌───────────────────────────────┐
            │     TRANSBANK / WEBPAY        │
            │                               │
            │ /pagar/{pedido}               │
            │ /transbank/callback           │
            │ ✅ EN USO                      │
            │                               │
            │ • Redirige a Webpay           │
            │ • Procesa pago                │
            │ • Retorna resultado           │
            └────────────┬──────────────────┘
                         │
                         ▼
            ┌───────────────────────────────┐
            │   CONFIRMACIÓN PEDIDO         │
            │                               │
            │ /pedidos/{pedido}/estado      │
            │ ✅ EN USO                      │
            │                               │
            │ • Ver estado del pedido       │
            │ • Datos enviados              │
            │ • Número de pedido            │
            └───────────────────────────────┘


┌───────────────────────────────────────────────────────────────────────┐
│                      PANEL ADMINISTRATIVO                             │
│                                                                       │
│ /admin (Requiere: Autenticado + Admin)                               │
│ ✅ EN USO PERO CON FUNCIONALIDADES NO NECESARIAS                      │
└────────────────────┬──────────────────────────────────────────────────┘
                     │
        ┌────────────┼────────────┐
        │            │            │
        ▼            ▼            ▼
    ┌───────┐   ┌───────┐   ┌──────────┐
    │CATEGO-│   │PRODUC-│   │COTIZACIO-│
    │RÍAS   │   │TOS    │   │NES       │
    │       │   │       │   │          │
    │Create │   │Create │   │Ver/Editar│
    │Edit   │   │Edit   │   │Eliminar  │
    │Delete │   │Delete │   │          │
    │       │   │       │   │❌ NO SE  │
    │✅ USAR│   │✅ USAR│   │   USA    │
    └───────┘   └───────┘   └──────────┘
        │           │
        └─────┬─────┘
              │
              ▼
        ┌────────────┐
        │  PEDIDOS   │
        │            │
        │ Ver listado│
        │ Ver detalle│
        │ Cambiar    │
        │ estado     │
        │            │
        │✅ EN USO    │
        └────────────┘
```

---

## 📋 INVENTARIO DETALLADO

### ✅ **EN USO - MANTENER**

#### **Rutas Públicas (Welcome)**
- `Route::get('/', ...)` → `welcome.blade.php` ✅

#### **Catálogo y Productos**
- `Route::get('/catalogo', ...)` → `catalogo/index.blade.php` ✅
- `Route::get('/catalogo/{producto}', ...)` → `catalogo/show.blade.php` ✅
- `Route::get('/buscar', ...)` → (busca en index) ✅

#### **Diseñador 3D**
- `Route::get('/designer/tazas', ...)` → `catalogo/designer-tazas.blade.php` ✅

#### **Carrito**
- `Route::post('/carrito', ...)` → (store en carrito) ✅
- `Route::get('/carrito', ...)` → `carrito/carrito.blade.php` ✅
- `Route::delete('/carrito/{item}', ...)` → (delete item) ✅

#### **Checkout (Guest)**
- `Route::get('/checkout/guest', ...)` → `checkout/guest.blade.php` ✅
- `Route::post('/checkout/guest', ...)` → (store guest pedido) ✅

#### **Transbank**
- `Route::get('/pagar/{pedido}', ...)` ✅
- `Route::post('/transbank/callback', ...)` ✅

#### **Pedidos (Público)**
- `Route::get('/pedidos/{pedido}/estado', ...)` ✅

#### **Autenticación**
- `Route::get('/login', ...)` → `auth/login.blade.php` ✅
- `Route::post('/login', ...)` ✅
- `Route::get('/register', ...)` → `auth/register.blade.php` ✅
- `Route::post('/register', ...)` ✅

#### **Admin Panel**
- `Route::get('/admin', ...)` → `admin/dashboard.blade.php` ✅
- Categorías (CRUD completo) ✅
- Productos (CRUD completo) ✅
- Pedidos (Ver, Cambiar Estado) ✅

---

### ❌ **NO SE USA - ELIMINAR**

#### **Home para Clientes**
```
Route::get('/home', ...)
- Vista: resources/views/home.blade.php
- Razón: Solo hay admin, sin clientes autenticados
- Controlador: No tiene controlador, es inline
```

#### **Cotizador (Completo)**
```
Route::get('/cotizador', ...)
Route::post('/cotizador', ...)
- Vistas: resources/views/cotizador/cotizador.blade.php
- Controlador: app/Http/Controllers/CotizadorController.php
- Ruta: POST /catalogo/save-cotizacion (solo guarda)
- Razón: Dicen que NO lo usarán
```

#### **Admin - Cotizaciones (CRUD)**
```
Route::get('/admin/cotizaciones', ...)
Route::get('/admin/cotizaciones/{cotizacion}', ...)
Route::post('/admin/cotizaciones/{cotizacion}/estado', ...)
Route::delete('/admin/cotizaciones/{cotizacion}', ...)
- Vistas: 
  - resources/views/admin/cotizaciones/index.blade.php
  - resources/views/admin/cotizaciones/show.blade.php
- Controlador: app/Http/Controllers/AdminController.php (métodos de cotizaciones)
- Razón: Sin cotizador, no se usan cotizaciones
```

#### **Perfil de Usuario**
```
Route::get('/perfil/editar', ...)
Route::put('/perfil', ...)
- Vista: resources/views/profile/edit.blade.php
- Controlador: app/Http/Controllers/ProfileController.php
- Razón: Solo hay admin, no hay clientes que editen perfil
```

#### **Pedidos para Clientes Autenticados**
```
Route::get('/pedidos', ...)  [Requiere auth]
Route::get('/pedidos/{pedido}', ...)  [Requiere auth]
- Vistas: 
  - resources/views/pedidos/index.blade.php
  - resources/views/pedidos/show.blade.php
- Controlador: app/Http/Controllers/PedidoController.php
- Razón: Sin clientes autenticados, solo guests + admin
- Nota: Admin tiene sus propias rutas para pedidos
```

#### **Checkout para Usuarios Autenticados**
```
Route::get('/checkout', ...)  [Requiere auth]
Route::post('/checkout', ...)  [Requiere auth]
- Controlador: app/Http/Controllers/CheckoutController.php (métodos store, index)
- Razón: Sin clientes autenticados, solo guests
```

#### **Otras Páginas Públicas**
```
Route::get('/nosotros', ...)
Route::get('/contacto', ...)
- Vistas: 
  - resources/views/nosotros/index.blade.php
  - resources/views/contacto/index.blade.php
- Razón: Podría decirse que no son críticas, pero son info (Mantener por ahora)
```

#### **Password Reset**
```
Route::get('/forgot-password', ...)
Route::post('/forgot-password', ...)
Route::get('/reset-password/{token}', ...)
Route::post('/reset-password', ...)
- Vistas: 
  - resources/views/auth/forgot-password.blade.php
  - resources/views/auth/reset-password.blade.php
- Controlador: app/Http/Controllers/Auth/PasswordResetController.php
- Razón: Solo admin login, puede dejarse por si se necesita en el futuro
```

---

## 🗂️ MODELOS NO USADOS

```
app/Models/Cotizacion.php       ❌ No se usa
app/Models/Archivo.php           ⚠️ Poco usado (revisar)
```

**Modelos en uso:**
- `User.php` ✅
- `Producto.php` ✅
- `Categoria.php` ✅
- `Pedido.php` ✅
- `ItemPedido.php` ✅
- `Carrito.php` ✅
- `ItemCarrito.php` ✅

---

## 🔧 CONTROLADORES NO USADOS

```
app/Http/Controllers/CotizadorController.php     ❌ Eliminar
app/Http/Controllers/ProfileController.php       ❌ Eliminar
app/Http/Controllers/PedidoController.php        ⚠️ Parcialmente usado
  - Métodos para clientes auth NO se usan
  - Método showPublic SI se usa (guests)
```

---

## 📧 EMAILS

```
resources/views/emails/nuevo-pedido-admin.blade.php      ✅ Usar
resources/views/emails/pedido-confirmado.blade.php       ✅ Usar
resources/views/emails/reset-password.blade.php          ⚠️ Mantener
```

---

## 📊 RESUMEN DE ELIMINACIONES

| Categoría | Archivo | Razón | Prioridad |
|-----------|---------|-------|-----------|
| **Rutas** | Cotizador (3 rutas) | No se usa | 🔴 ALTA |
| **Rutas** | Home (/home) | Sin clientes auth | 🔴 ALTA |
| **Rutas** | Pedidos auth (2 rutas) | Sin clientes auth | 🟡 MEDIA |
| **Rutas** | Checkout auth (2 rutas) | Sin clientes auth | 🟡 MEDIA |
| **Rutas** | Perfil (2 rutas) | Sin clientes auth | 🔴 ALTA |
| **Vistas** | home.blade.php | Sin clientes auth | 🔴 ALTA |
| **Vistas** | cotizador/cotizador.blade.php | No se usa | 🔴 ALTA |
| **Vistas** | profile/edit.blade.php | Sin clientes auth | 🔴 ALTA |
| **Vistas** | pedidos/index.blade.php | Sin clientes auth | 🟡 MEDIA |
| **Vistas** | pedidos/show.blade.php | Sin clientes auth | 🟡 MEDIA |
| **Vistas** | auth/forgot-password.blade.php | Opcional | 🟢 BAJA |
| **Vistas** | auth/reset-password.blade.php | Opcional | 🟢 BAJA |
| **Controladores** | CotizadorController.php | No se usa | 🔴 ALTA |
| **Controladores** | ProfileController.php | Sin clientes auth | 🔴 ALTA |
| **Controladores** | PedidoController.php | Parcialmente | 🟡 MEDIA |
| **Modelos** | Cotizacion.php | No se usa | 🔴 ALTA |
| **Migraciones** | Cotizaciones table | No se usa | 🟡 MEDIA |

---

## 🎯 PLAN DE LIMPIEZA

### **Fase 1: Eliminaciones Críticas (ALTA)**

1. **Eliminar Cotizador completamente:**
   - `app/Http/Controllers/CotizadorController.php`
   - `resources/views/cotizador/cotizador.blade.php`
   - Rutas del cotizador en `routes/web.php`
   - Métodos de cotizador en `AdminController.php`
   - Vistas admin cotizador

2. **Eliminar Home de Clientes:**
   - `resources/views/home.blade.php`
   - Ruta `/home` en `routes/web.php`

3. **Eliminar Perfil de Usuario:**
   - `app/Http/Controllers/ProfileController.php`
   - `resources/views/profile/edit.blade.php`
   - Rutas de perfil en `routes/web.php`

### **Fase 2: Limpieza de Controladores (MEDIA)**

1. **Limpiar AdminController.php:**
   - Remover métodos de cotizaciones
   - Remover métodos que no se usan

2. **Limpiar PedidoController.php:**
   - Mantener solo `showPublic`
   - Remover `index` y `show` (para clientes auth)

3. **Simplificar CheckoutController.php:**
   - Mantener solo `indexPublic` y `storeGuest`
   - Remover `index` y `store` (para clientes auth)

### **Fase 3: Modelos (MEDIA)**

1. **Revisar Cotizacion.php:**
   - Decidir si mantener por historial o eliminar completamente

2. **Revisar Archivo.php:**
   - Verificar si se usa en algún lado

---

## 🔍 NOTA IMPORTANTE

**Estos archivos podría conservarse "por si acaso" pero NO se usan actualmente:**

- Password Reset (forgot-password, reset-password)
- Nosotros.blade.php
- Contacto.blade.php

**Si en el futuro necesitas:**
- Agregar clientes autenticados → reactivar /home, /perfil, checkout auth, pedidos auth
- Agregar cotizaciones → reactivar cotizador completo
- Recuperación de password → ya está implementado

---

## ✅ RECOMENDACIÓN FINAL

**Eliminar en este orden:**

1. Rutas de cotizador (routes/web.php)
2. Vista cotizador
3. Controlador CotizadorController
4. Métodos de cotizador en AdminController
5. Vistas admin cotizador
6. ProfileController y vista profile
7. Home.blade.php y ruta /home
8. Rutas de auth/checkout para clientes auth
9. Métodos de PedidoController que no se usan
10. Métodos de CheckoutController que no se usan
11. Modelo Cotizacion.php

**Mantener todo lo demás sin cambios.**

---

