# 🖨️ MM Impresiones - Sistema de Pedidos Online

Sistema web completo para gestión de pedidos de impresión con integración de pagos mediante Webpay Plus (Transbank).

## ✨ Características Principales

- 🛒 E-Commerce completo con catálogo y cotizador personalizado
- 💳 Integración con Webpay Plus (Transbank)
- 👥 Gestión de usuarios con ubicaciones chilenas (región/ciudad/comuna)
- 📊 Panel de administración completo
- �� Sistema de subida y visualización de archivos
- 📧 Notificaciones por email
- 🎨 Interfaz moderna con Tailwind CSS

## 🚀 Instalación Rápida

```bash
git clone https://github.com/bernardo-zacarias/MM_Impresiones.git
cd MM_Impresiones
composer install
npm install && npm run build
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan storage:link
php artisan serve
```

## 📚 Documentación

### Despliegue y Producción
- **[GUIA_HOSTGATOR.md](GUIA_HOSTGATOR.md)** - Guía completa para despliegue en HostGator (cPanel)
- **[GUIA_PRODUCCION.md](GUIA_PRODUCCION.md)** - Guía general de despliegue a producción

### Integración de Pagos (Transbank)
- **[GUIA_PRUEBAS_TRANSBANK.md](GUIA_PRUEBAS_TRANSBANK.md)** - Proceso completo de certificación con Transbank
- **[TARJETAS_PRUEBA_TRANSBANK.md](TARJETAS_PRUEBA_TRANSBANK.md)** - Tarjetas de prueba para ambiente de integración

### Configuración
- **[GUIA_CONFIGURACION_EMAIL.md](GUIA_CONFIGURACION_EMAIL.md)** - Configuración de correos (SMTP, Gmail, HostGator)
- **[SEGURIDAD_CHECKLIST.md](SEGURIDAD_CHECKLIST.md)** - Checklist de seguridad para producción

### Historial y Fixes
- **[FIX_ARCHIVOS_PEDIDOS.md](FIX_ARCHIVOS_PEDIDOS.md)** - Documentación del fix de archivos en pedidos

### Documentación Archivada
Los documentos redundantes o versiones anteriores se encuentran en `docs_archivo/`

## 🛠️ Stack Tecnológico

- Laravel 12.0 (PHP 8.2+)
- MySQL
- Transbank SDK 5.1.0
- Tailwind CSS
- JavaScript

## ✅ Estado

**Listo para Producción** - Versión 1.0.0

---

Desarrollado por Bernardo Zacarias © 2025
