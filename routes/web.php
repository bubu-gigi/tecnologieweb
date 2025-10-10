<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\TecnicoAssistenzaController;
use App\Http\Controllers\AmministratoreController;
use App\Http\Controllers\TecnicoAziendaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index'])->name('home');

Route::middleware(['auth', 'can:isTecnicoAssistenza'])->group(function () {
    Route::get('/tecnico-assistenza/dashboard', function () {
        return view('tecnicoAssistenza.dashboard');
    })->name('tecnicoAssistenza.dashboard');
    Route::get('/prodotti/search', [TecnicoAssistenzaController::class, 'searchProdotti'])
         ->name('prodotti.search');
    Route::get('/prodotti/{id}', [TecnicoAssistenzaController::class, 'showProdotto'])
        ->name('prodotti.show');
});

Route::middleware(['auth', 'can:isTecnicoAzienda'])->group(function () {
    Route::get('/tecnico-azienda/dashboard', function () {
        return view('tecnicoAzienda.dashboard');
    })->name('tecnicoAzienda.dashboard');

    Route::get('/tecnico-azienda/prodotti/search', [TecnicoAziendaController::class, 'searchProdotti'])
         ->name('tecnicoAzienda.prodotti.search');
    Route::get('/tecnico-azienda/prodotti/{id}', [TecnicoAziendaController::class, 'showProdotto'])
        ->name('tecnicoAzienda.prodotti.show');

    Route::delete('/tecnico-azienda/malfunzionamenti/{id}', [TecnicoAziendaController::class, 'deleteMalfunzionamento'])
        ->name('malfunzionamento.delete');

    Route::get('/tecnico-azienda/prodotti/{id}/malfunzionamenti/nuovo', [TecnicoAziendaController::class, 'createFormMalfunzionamento'])
    ->name('malfunzionamento.formNuovo');

    Route::post('/tecnico-azienda/prodotti/{id}/malfunzionamenti', [TecnicoAziendaController::class, 'createMalfunzionamento'])
        ->name('malfunzionamento.create');

    Route::get('/tecnico-azienda/malfunzionamenti/{id}/edit', [TecnicoAziendaController::class, 'editMalfunzionamento'])
        ->name('malfunzionamento.edit');
    Route::put('/tecnico-azienda/malfunzionamenti/{id}', [TecnicoAziendaController::class, 'updateMalfunzionamento'])
        ->name('malfunzionamento.update');
});

Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('/amministratore', [AmministratoreController::class, 'index'])->name('amministratore.dashboard');

    Route::get('/amministratore/prodotti' ,[AmministratoreController::class, 'gestioneProdotti'])->name('amministratore.gestioneProdotti');
});

require __DIR__.'/auth.php';
