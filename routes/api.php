<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CemiterioController;
use App\Http\Controllers\QuadraController;
use App\Http\Controllers\JazigoController;
use App\Http\Controllers\SepultamentoController;

Route::apiResource('cemiterios', CemiterioController::class);
Route::apiResource('quadras', QuadraController::class);
Route::apiResource('jazigos', JazigoController::class);
Route::apiResource('sepultamentos', SepultamentoController::class);
