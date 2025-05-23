<?php

use App\Http\Controllers\LoopController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Loop;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/loops', [LoopController::class, 'index'])->name('loops.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard/photo', [ProfileController::class, 'updatePhoto'])->name('dashboard.photo');
    Route::get('/loops/create', [LoopController::class, 'create'])->name('loops.create');
    Route::post('/loops', [LoopController::class, 'store'])->name('loops.store');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tags/{tag}', [LoopController::class, 'byTag'])->name('loops.byTag');
});

Route::get('/', function () {
    $loops = Loop::with(['user', 'tags'])->latest()->take(3)->get();
    return view('welcome', compact('loops'));
})->name('home');
Route::get('/loops/tag/{tag}', [App\Http\Controllers\LoopController::class, 'byTag'])->name('loops.byTag');

Route::get('/loops', [LoopController::class, 'list'])->name('loops.index');
Route::get('/loops/create', [LoopController::class, 'create'])->middleware('auth')->name('loops.create');

// Login / Register (de Breeze)
require __DIR__ . '/auth.php';
