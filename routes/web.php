<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\AlunoController;

Route::get('/', function () {
    return redirect()->route('aulas.index');
});

Route::resource('aulas', AulaController::class);
Route::resource('pagamentos', PagamentoController::class);
Route::resource('alunos', AlunoController::class);

// Public registration for students
Route::get('/register', [AlunoController::class, 'publicCreate'])->name('alunos.register');
Route::post('/register', [AlunoController::class, 'publicStore'])->name('alunos.register.store');
