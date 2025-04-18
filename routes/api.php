<?php

use App\Http\Controllers\DipartimentoController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(DipartimentoController::class)->group(function () {
    Route::get('/departments', 'showAll');
    Route::get('/departments/{id}', 'show');
    Route::post('/departments', 'store');
    Route::put('/departments/{id}', 'update');
    Route::delete('/departments/{id}', 'delete');
});
