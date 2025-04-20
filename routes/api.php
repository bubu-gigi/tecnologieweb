<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DipartimentoController;
use App\Http\Controllers\MedicoController;
use Illuminate\Support\Facades\Route;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(DipartimentoController::class)->group(function () {
    Route::get('/departments', 'index');
    Route::get('/departments/{id}', 'show');
    Route::post('/departments', 'store');
    Route::put('/departments/{id}', 'update');
    Route::delete('/departments/{id}', 'destroy');
});

Route::controller(MedicoController::class)->group(function () {
    Route::get('/doctors', 'index');
    Route::get('/doctors/{id}', 'show');
    Route::post('/doctors', 'store');
    Route::put('/doctors/{id}', 'update');
    Route::delete('/doctors/{id}', 'destroy');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth')->name('me');

