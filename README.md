
<p align="center">
    <img src="https://i.imgur.com/LIInH6v.png" width="200" alt="LooperKlon Logo">
</p>

<p align="center">
    Plataforma colaborativa de loops musicales desarrollada en Laravel.
</p>

<p align="center">
    <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-Framework-red" alt="Laravel"></a>
    <a href="#"><img src="https://img.shields.io/badge/License-MIT-blue.svg" alt="License"></a>
</p>

---

## 🚀 Descripción

**LooperKlon** es una aplicación web construida con Laravel que permite a productores musicales compartir, descubrir y descargar loops musicales. Los usuarios pueden subir sus creaciones, etiquetarlas, escuchar previas con visualización de ondas y gestionar su perfil con foto e información.

## 🔥 Características

- Registro e inicio de sesión de usuarios con Laravel Breeze
- Subida de loops con información de BPM, tonalidad y etiquetas
- Visualización de onda de audio con [WaveSurfer.js](https://wavesurfer-js.org)
- Filtros de búsqueda por título, BPM, tonalidad, usuario y etiquetas
- Página de inicio moderna con hero animado y loops destacados
- Panel de usuario con gestión de loops y cambio de foto de perfil

## 📦 Instalación

```bash
git clone https://github.com/tuusuario/looperklon.git
cd looperklon
composer install
npm install && npm run dev
cp .env.example .env
php artisan key:generate
```

Configura tu base de datos en `.env`, luego ejecuta:

```bash
php artisan migrate
php artisan storage:link
php artisan serve
```

## 🛠️ Tecnologías usadas

- Laravel 12
- Bootstrap 5
- JavaScript + WaveSurfer.js
- Tagify (para etiquetas)
- MySQL / SQLite
- Breeze (autenticación)

## 🙋 Preguntas Frecuentes (FAQ)

### ¿Qué tipo de archivos puedo subir?
Actualmente se permiten archivos `.mp3` y `.wav`.

### ¿Dónde se almacenan los archivos?
Los archivos se almacenan en `storage/app/public/loops`. Laravel los sirve a través del enlace simbólico creado con `php artisan storage:link`.

### ¿Por qué no se ve mi logo o mis archivos?
Verifica que hayas ejecutado `php artisan storage:link` y que tus archivos estén dentro de `storage/app/public`.

### ¿Puedo subir loops sin estar registrado?
No. Necesitas crear una cuenta e iniciar sesión para poder subir contenido.

### ¿Dónde se actualiza la foto de perfil?
Desde el panel de usuario (dashboard), puedes subir una nueva foto en la sección de perfil.

## 📃 Licencia

Este proyecto está bajo la licencia [MIT](https://opensource.org/licenses/MIT).

---

> Desarrollado con ❤️ por EduRosa.
