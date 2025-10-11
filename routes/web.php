<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\TecnicoAssistenzaController;
use App\Http\Controllers\AmministratoreController;
use App\Http\Controllers\TecnicoAziendaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index'])->name('home');

/* ===========================
 * TECNICO ASSISTENZA
 * =========================== */
Route::middleware(['auth', 'can:isTecnicoAssistenza'])->group(function () {
    Route::get('/tecnico-assistenza/dashboard', function () {
        return view('tecnicoAssistenza.dashboard');
    })->name('tecnicoAssistenza.dashboard');

    Route::get('/prodotti/search', [TecnicoAssistenzaController::class, 'searchProdotti'])
         ->name('prodotti.search');

    Route::get('/prodotti/{id}', [TecnicoAssistenzaController::class, 'showProdotto'])
         ->name('prodotti.show');
});

/* ===========================
 * TECNICO AZIENDA
 * =========================== */
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

/* ===========================
 * AMMINISTRATORE
 * =========================== */
Route::middleware(['auth', 'can:isAdmin'])->group(function () {

    Route::get('/amministratore', [AmministratoreController::class, 'index'])
        ->name('amministratore.dashboard');

    /* --- GESTIONE PRODOTTI --- */
    Route::get('/amministratore/prodotti', [AmministratoreController::class, 'gestioneProdotti'])
        ->name('amministratore.gestioneProdotti');

    Route::get('/amministratore/prodotti/nuovo', [AmministratoreController::class, 'createProdotto'])
        ->name('amministratore.prodotto.create');

    Route::post('/amministratore/prodotti', [AmministratoreController::class, 'storeProdotto'])
        ->name('amministratore.prodotto.store');

    Route::get('/amministratore/prodotti/{id}/edit', [AmministratoreController::class, 'editProdotto'])
        ->name('amministratore.prodotto.edit');

    Route::put('/amministratore/prodotti/{id}', [AmministratoreController::class, 'updateProdotto'])
        ->name('amministratore.prodotto.update');

    Route::delete('/amministratore/prodotti/{id}', [AmministratoreController::class, 'deleteProdotto'])
        ->name('amministratore.prodotto.delete');

    /* --- GESTIONE UTENTI --- */
    Route::get('/amministratore/utenti', [AmministratoreController::class, 'gestioneUtenti'])
        ->name('amministratore.gestioneUtenti');

    /* --- GESTIONE TECNICI ASSISTENZA --- */
    Route::get('/amministratore/tecnici-assistenza', [AmministratoreController::class, 'gestioneTecniciAssistenza'])
        ->name('amministratore.gestioneTecniciAssistenza');

    Route::get('/amministratore/tecnici-assistenza/nuovo', [AmministratoreController::class, 'createTecnicoAssistenza'])
        ->name('amministratore.tecnicoAssistenza.create');

    Route::post('/amministratore/tecnici-assistenza', [AmministratoreController::class, 'storeTecnicoAssistenza'])
        ->name('amministratore.tecnicoAssistenza.store');

    Route::get('/amministratore/tecnici-assistenza/{id}/edit', [AmministratoreController::class, 'editTecnicoAssistenza'])
        ->name('amministratore.tecnicoAssistenza.edit');

    Route::put('/amministratore/tecnici-assistenza/{id}', [AmministratoreController::class, 'updateTecnicoAssistenza'])
        ->name('amministratore.tecnicoAssistenza.update');

    Route::delete('/amministratore/tecnici-assistenza/{id}', [AmministratoreController::class, 'deleteTecnicoAssistenza'])
        ->name('amministratore.tecnicoAssistenza.delete');


// GESTIONE STAFF (tecnici_azienda)
Route::get('/amministratore/tecnici-azienda', [AmministratoreController::class, 'gestioneTecniciAzienda'])
    ->name('amministratore.gestioneTecniciAzienda');

Route::get('/amministratore/tecnici-azienda/nuovo', [AmministratoreController::class, 'createTecnicoAzienda'])
    ->name('amministratore.tecnicoAzienda.create');

Route::post('/amministratore/tecnici-azienda', [AmministratoreController::class, 'storeTecnicoAzienda'])
    ->name('amministratore.tecnicoAzienda.store');

Route::get('/amministratore/tecnici-azienda/{id}/edit', [AmministratoreController::class, 'editTecnicoAzienda'])
    ->name('amministratore.tecnicoAzienda.edit');

Route::put('/amministratore/tecnici-azienda/{id}', [AmministratoreController::class, 'updateTecnicoAzienda'])
    ->name('amministratore.tecnicoAzienda.update');

Route::delete('/amministratore/tecnici-azienda/{id}', [AmministratoreController::class, 'deleteTecnicoAzienda'])
    ->name('amministratore.tecnicoAzienda.delete');
});

require __DIR__.'/auth.php';