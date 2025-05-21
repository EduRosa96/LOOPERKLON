<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoopController;

// Página principal muestra los loops
Route::get('/', [LoopController::class, 'index'])->name('loops.index');

// Mostrar todos los loops
Route::get('/loops', [LoopController::class, 'index']);

// Formulario para crear un loop
Route::get('/loops/create', [LoopController::class, 'create'])->name('loops.create');

// Guardar un nuevo loop
Route::post('/loops', [LoopController::class, 'store'])->name('loops.store');

// Ruta de prueba (puedes eliminarla si no la usas)
Route::get('/task', function () {
    return "task desde web.php";
});