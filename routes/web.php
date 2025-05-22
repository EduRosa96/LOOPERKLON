<?php

use App\Http\Controllers\LoopController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Página de inicio → redirige al listado de loops
Route::get('/', function () {
    return view('welcome');
});

// Panel de usuario (dashboard)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas públicas
Route::get('/loops', [LoopController::class, 'index'])->name('loops.index');

// Rutas protegidas (requieren login)
Route::middleware('auth')->group(function () {
    Route::get('/loops/create', [LoopController::class, 'create'])->name('loops.create');
    Route::post('/loops', [LoopController::class, 'store'])->name('loops.store');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/loops', [LoopController::class, 'list'])->name('loops.index');
Route::get('/loops/tag/{tag}', [LoopController::class, 'byTag'])->name('loops.byTag');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard/photo', [ProfileController::class, 'updatePhoto'])->name('dashboard.photo');
});

require __DIR__ . '/auth.php';
