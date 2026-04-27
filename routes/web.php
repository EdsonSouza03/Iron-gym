<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\AlunoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('welcome');
});

// Public registration for students
Route::get('/register', [AlunoController::class, 'publicCreate'])->name('alunos.register');
Route::post('/register', [AlunoController::class, 'publicStore'])->name('alunos.register.store');

Route::get('/dashboard', function () {
    return redirect()->route('aulas.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin routes
    Route::resource('aulas', AulaController::class);
    Route::resource('pagamentos', PagamentoController::class);
    Route::resource('alunos', AlunoController::class);
});

require __DIR__.'/auth.php';
