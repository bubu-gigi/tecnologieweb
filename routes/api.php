<?php

use App\Http\Controllers\DipartimentoController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/departments', [DipartimentoController::class, 'showAll'])
    ->name('dipartimenti.showAll');

Route::get('/departments/{id}', [DipartimentoController::class, 'show'])
    ->name('dipartimenti.show');
