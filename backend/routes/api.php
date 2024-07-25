<?php

use App\Http\Controllers\AcessibilidadesController;
use App\Http\Controllers\VeiculosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AcessibilidadesController::class)->group(function(){
    Route::get('/acessibilidades', 'get');
    Route::post('/acessibilidades', 'post');
});

Route::controller(VeiculosController::class)->group(function(){
    Route::get('/veiculos', 'get');
});
