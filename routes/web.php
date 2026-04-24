<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\PagamentoController;

Route::get('/', function () {
    return redirect()->route('aulas.index');
});

Route::resource('aulas', AulaController::class);
Route::resource('pagamentos', PagamentoController::class);
