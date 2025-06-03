<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\DipartimentoController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PrenotazioniController;
use App\Http\Controllers\PrestazioneController;
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

Route::controller(PrenotazioniController::class)->group(function () {
    Route::get('/reservations', 'index');
    Route::get('/reservations/{id}', 'show');
    Route::post('/reservations', 'store')->name('reservations.store');
    Route::put('/reservations/{id}', 'update');
    Route::delete('/reservations/{id}', 'destroy');
});

Route::controller(PrestazioneController::class)->group(function () {
    Route::get('/procedures', 'index');
    Route::get('/procedures/{id}', 'show');
    Route::post('/procedures', 'store');
    Route::put('/procedures/{id}', 'update');
    Route::delete('/procedures/{id}', 'destroy');
});

Route::controller(AgendaController::class)->group(function () {
    Route::get('/procedures/{procedure}/agenda-template', [AgendaController::class, 'getTemplate']);
    Route::get('/procedures/schedules', 'index');
    Route::get('/procedures/{procedure}/schedules', 'show')->name('procedures.schedules.show');
    Route::post('/procedures/{procedure}/schedules', action: 'store')->name('procedures.schedules.save');
    Route::put('/procedures/{procedure}/schedules', 'update');
    Route::delete('/procedures/{procedure}/schedules', 'destroy');
});
