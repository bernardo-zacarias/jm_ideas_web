# 🗑️ LISTA DE ARCHIVOS Y CARPETAS A ELIMINAR

Esta lista contiene todos los archivos, carpetas y documentos innecesarios que pueden ser eliminados del proyecto para limpiar la basura acumulada.

---

## 📄 DOCUMENTOS DE CONFIGURACIÓN Y GUÍAS (BASURA)

Estos archivos fueron documentación temporal durante el desarrollo. **SE PUEDEN ELIMINAR TODOS**.

### En la raíz del proyecto:

- `FIXES_COMPRA_SIN_REGISTRO.md` - Notas de fixes antiguos
- `FIX_ARCHIVOS_PEDIDOS.md` - Documentación obsoleta
- `FLUJO_COMPRA_SIN_REGISTRO_FINAL.md` - Documentación antigua de checkout
- `GUEST_CHECKOUT_IMPLEMENTATION.md` - Documentación de implementación (ahora funciona)
- `GUEST_CHECKOUT_SYSTEM.md` - Documentación antigua de guest checkout
- `GUIA_CONFIGURACION_EMAIL.md` - Guía antigua de email
- `GUIA_HOSTGATOR.md` - Guía de hosting antiguo
- `GUIA_IMAGENES_CATALOGO.md` - Guía de imágenes obsoleta
- `GUIA_IMPLEMENTACION_HOSTGATOR.md` - Guía de implementación antigua
- `GUIA_PRODUCCION.md` - Guía de producción antigua
- `GUIA_PRUEBAS_TRANSBANK.md` - Documentación de pruebas
- `HERO_SECTION_MEJORAS.md` - Notas de hero section
- `LIMPIEZA_WELCOME.md` - Notas de limpieza
- `LOGO_FOOTER_INSTRUCCIONES.md` - Instrucciones logo
- `RESUMEN_DESPLIEGUE.md` - Resumen antiguo de despliegue
- `SEGURIDAD_CHECKLIST.md` - Checklist de seguridad
- `TARJETAS_PRUEBA_TRANSBANK.md` - Tarjetas de prueba (información sensible)
- `TESTING_GUIDE.md` - Guía de testing
- `ARCHIVOS_A_SUBIR.md` - Lista antigua
- `CAROUSEL_DINAMICO.md` - Notas carousel
- `CAROUSEL_MEJORA.md` - Notas carousel
- `CARRITO_NUEVO_ANTIGUO.md` - Notas carrito
- `CAMBIOS_COMPRA_SIN_REGISTRO.md` - Cambios antiguos
- `DEPLOY_A_PRODUCCION.md` - Notas deploy
- `ARQUITECTURA_CARRITO_BD_SESION.md` - Arquitectura antigua

### En carpeta `docs_archivo/`:

- `docs_archivo/ACCESO_CORREO.md` - Acceso correo antiguo
- `docs_archivo/GUIA_DESPLIEGUE_HOSTGATOR.md` - Guía antigua
- `docs_archivo/GUIA_DESPLIEGUE_PRODUCCION.md` - Guía antigua
- `docs_archivo/GUIA_PRUEBA_WEBPAY.md` - Guía antigua
- `docs_archivo/README_Laravel.md` - README duplicado

**Total: ~28 archivos .md a eliminar**

---

## 🔧 SCRIPTS DE SHELL (BASURA - ALGUNOS)

Algunos son útiles, otros son antiguos. Aquí están todos:

### Scripts para ELIMINAR:

- `deploy_commands.sh` - Script antiguo de deploy
- `export-database.sh` - Script antiguo de exportar BD
- `fix-produccion.sh` - Script de fixes antiguo
- `manage-images.sh` - Script de gestión de imágenes
- `prepare-deploy.sh` - Script de preparación antiguo
- `prepare-hostgator.sh` - Script para HostGator (ya no en uso)
- `prepare-manual.sh` - Script de preparación manual antiguo
- `setup-catalogo.sh` - Script de configuración antiguia
- `ver-catalogo.sh` - Script para ver catálogo
- `ver_emails.sh` - Script para ver emails
- `verificar-deploy.sh` - Script de verificación antiguo

**Total: 11 scripts .sh a eliminar**

---

## 🧪 ARCHIVOS DE PRUEBA (BASURA)

Estos son archivos creados para testing que no son parte de la aplicación:

- `test-categorias.php` - Test de categorías
- `test-email.php` - Test de email
- `test-guest-checkout.php` - Test de guest checkout (reciente)
- `verificar-catalogo.php` - Script de verificación
- `phpunit.xml` - Configuración de PHPUnit (si no usas tests)

**Total: 5 archivos de test a eliminar**

---

## 🖼️ IMÁGENES NO UTILIZADAS

### En `public/images/`:

- `public/images/site/` - Carpeta de imágenes antiguas del sitio (revisar si se usan)
- `public/images/logo/` - Logos antiguos (mantener si algunos se usan en el sitio)
- `public/images/hero/` - Heroes antiguos

**Recomendación**: Revisar cada carpeta y eliminar solo las imágenes que NO se usen actualmente.

---

## 📁 CARPETAS A ELIMINAR

- `docs_archivo/` - Carpeta de documentación antigua (completa)
- `.vscode/` - Configuración VS Code personal (opcional, pero a menudo basura)
- `tests/` - Carpeta de tests unitarios (si no usas testing)

---

## 🔍 ARCHIVOS DE CONFIGURACIÓN (OPCIONAL)

Estos son opcionales y dependen de si los usas:

- `.phpunit.result.cache` - Cache de PHPUnit
- `.env.production` - Copia de .env (mantener .env.example)
- `.env.production.example` - Ejemplo de env
- `.env.transbank.example` - Ejemplo de transbank
- `.editorconfig` - Configuración del editor

**Recomendación**: Mantener solo `.env.example` y eliminar los demás.

---

## 📋 RESUMEN POR CATEGORÍA

| Categoría | Cantidad | Acción |
|-----------|----------|--------|
| **Documentos .md** | ~28 archivos | ❌ ELIMINAR TODOS |
| **Scripts .sh** | 11 scripts | ❌ ELIMINAR TODOS |
| **Archivos test .php** | 5 archivos | ❌ ELIMINAR TODOS |
| **Carpeta docs_archivo/** | 5 archivos | ❌ ELIMINAR CARPETA COMPLETA |
| **Carpeta tests/** | Varios | ❌ ELIMINAR si no usas testing |
| **.vscode/** | Configuración | ⚠️ ELIMINAR (personal) |
| **Imágenes no usadas** | ~? archivos | ✅ REVISAR Y ELIMINAR |

---

## 📊 ESTIMACIÓN DE ESPACIO A LIBERAR

- **Documentos .md**: ~500 KB
- **Scripts .sh**: ~50 KB
- **Archivos test .php**: ~100 KB
- **Carpeta docs_archivo**: ~100 KB
- **Carpeta .vscode**: ~50 KB
- **Imágenes no usadas**: Pendiente de revisar

**Total posible a liberar: ~1-2 MB** (sin contar imágenes)

---

## ⚠️ ARCHIVOS A MANTENER

✅ **Estos deben mantenerse**:

- `README.md` - Documentación principal (REVISAR Y ACTUALIZAR)
- `composer.json` / `composer.lock` - Dependencias PHP
- `package.json` / `package.lock` - Dependencias Node
- `vite.config.js` - Configuración Vite
- `artisan` - CLI de Laravel
- `.env.example` - Ejemplo de configuración
- `.gitignore` - Git ignore
- `.gitattributes` - Git attributes
- `phpunit.xml` - Config PHPUnit (si lo usas)

---

## 🧹 PASOS PARA LIMPIAR

### Opción 1: Manual (Seguro)

```bash
# Eliminar documentos
rm FIXES_COMPRA_SIN_REGISTRO.md
rm FIX_ARCHIVOS_PEDIDOS.md
rm FLUJO_COMPRA_SIN_REGISTRO_FINAL.md
# ... etc (uno por uno)

# Eliminar scripts
rm deploy_commands.sh
rm export-database.sh
# ... etc

# Eliminar tests
rm test-categorias.php
rm test-email.php
rm test-guest-checkout.php
rm verificar-catalogo.php

# Eliminar carpetas
rm -rf docs_archivo
rm -rf tests
rm -rf .vscode
```

### Opción 2: Script de limpieza automático

```bash
#!/bin/bash

# Documentos
rm -f FIXES_COMPRA_SIN_REGISTRO.md
rm -f FIX_ARCHIVOS_PEDIDOS.md
rm -f FLUJO_COMPRA_SIN_REGISTRO_FINAL.md
rm -f GUEST_CHECKOUT_IMPLEMENTATION.md
rm -f GUEST_CHECKOUT_SYSTEM.md
rm -f GUIA_CONFIGURACION_EMAIL.md
rm -f GUIA_HOSTGATOR.md
rm -f GUIA_IMAGENES_CATALOGO.md
rm -f GUIA_IMPLEMENTACION_HOSTGATOR.md
rm -f GUIA_PRODUCCION.md
rm -f GUIA_PRUEBAS_TRANSBANK.md
rm -f HERO_SECTION_MEJORAS.md
rm -f LIMPIEZA_WELCOME.md
rm -f LOGO_FOOTER_INSTRUCCIONES.md
rm -f RESUMEN_DESPLIEGUE.md
rm -f SEGURIDAD_CHECKLIST.md
rm -f TARJETAS_PRUEBA_TRANSBANK.md
rm -f TESTING_GUIDE.md
rm -f ARCHIVOS_A_SUBIR.md
rm -f CAROUSEL_DINAMICO.md
rm -f CAROUSEL_MEJORA.md
rm -f CARRITO_NUEVO_ANTIGUO.md
rm -f CAMBIOS_COMPRA_SIN_REGISTRO.md
rm -f DEPLOY_A_PRODUCCION.md
rm -f ARQUITECTURA_CARRITO_BD_SESION.md

# Scripts shell
rm -f deploy_commands.sh
rm -f export-database.sh
rm -f fix-produccion.sh
rm -f manage-images.sh
rm -f prepare-deploy.sh
rm -f prepare-hostgator.sh
rm -f prepare-manual.sh
rm -f setup-catalogo.sh
rm -f ver-catalogo.sh
rm -f ver_emails.sh
rm -f verificar-deploy.sh

# Tests
rm -f test-categorias.php
rm -f test-email.php
rm -f test-guest-checkout.php
rm -f verificar-catalogo.php

# Carpetas
rm -rf docs_archivo
rm -rf .vscode
rm -rf tests

echo "✓ Limpieza completada"
```

---

## 🔐 CONSIDERACIONES DE SEGURIDAD

⚠️ **Antes de eliminar, considera**:

1. **Backup**: Hacer backup del proyecto antes de limpiar
2. **Git**: Si usas Git, simplemente hacer commit de las eliminaciones
3. **Información sensible**: Revisar si hay contraseñas o datos sensibles en los archivos a eliminar

---

## 📝 NOTA

Esta lista fue generada el **28 de diciembre de 2025**. Los archivos marcados como "basura" no son necesarios para el funcionamiento de la aplicación y pueden ser eliminados sin riesgos.

