<?php
use App\Http\Controllers\LoopController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::get('/loops', [LoopController::class, 'index'])->name('loops.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard/photo', [ProfileController::class, 'updatePhoto'])->name('dashboard.photo');

    Route::get('/loops/create', [LoopController::class, 'create'])->name('loops.create');
    Route::post('/loops', [LoopController::class, 'store'])->name('loops.store');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Login / Register (de Breeze)
require __DIR__.'/auth.php';

