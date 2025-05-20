<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoopController;


Route::get('/loops', [LoopController::class, 'index'])->name('loops.index');


Route::get('/loops/create', [LoopController::class, 'create']); // muestra el formulario
Route::post('/loops', [LoopController::class, 'store']);         // guarda el loop

Route::get('/', [LoopController::class, 'index'])->name('loops.index');
Route::get('/loops/create', [LoopController::class, 'create'])->name('loops.create');
Route::post('/loops', [LoopController::class, 'store'])->name('loops.store');

Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/task', function () {
    return "task desde web.php";
});