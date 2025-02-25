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
    Route::get('/acessibilidades/{id}', 'edit');
    Route::put('/acessibilidades/{id}', 'put');
    Route::delete('/acessibilidades/{id}', 'delete');
});

Route::controller(VeiculosController::class)->group(function(){
    Route::get('/veiculos', 'get');
    Route::post('/veiculos', 'post');
    Route::get('/veiculo/{id}', 'edit');
    Route::put('/veiculos/{id}', 'put');
    Route::delete('/veiculos/{id}', 'delete');
});
