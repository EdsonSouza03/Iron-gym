<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ProdutoController;

Route::get('/', function () {
    return redirect()->route('aulas.index');
});

Route::resource('aulas', AulaController::class);
Route::resource('noticias', NoticiaController::class);
Route::resource('pagamentos', PagamentoController::class);
Route::resource('produtos', ProdutoController::class);
