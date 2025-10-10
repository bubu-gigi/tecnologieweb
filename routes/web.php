<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\TecnicoAssistenzaController;
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

/*Route::middleware(['auth', 'can:isAdmin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/utenti', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('/admin/utenti/nuovo', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/utenti', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/utenti/{id}', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/utenti/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/utenti/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    Route::get('/admin/prestazioni', [AdminController::class, 'prestazioni'])->name('admin.services.index');
    Route::get('/admin/prestazioni/nuova', [AdminController::class, 'createPrestazione'])->name('admin.services.create');
    Route::post('/admin/prestazioni', [AdminController::class, 'storePrestazione'])->name('admin.services.store');
    Route::get('/admin/prestazioni/{id}', [AdminController::class, 'editPrestazione'])->name('admin.services.edit');
    Route::put('/admin/prestazioni/{id}', [AdminController::class, 'updatePrestazione'])->name('admin.services.update');
    Route::delete('/admin/prestazioni/{id}', [AdminController::class, 'deletePrestazione'])->name('admin.services.delete');

    Route::get('/admin/dipartimenti', [AdminController::class, 'dipartimenti'])->name('admin.departments.index');
    Route::get('/admin/dipartimenti/nuovo', [AdminController::class, 'createDipartimento'])->name('admin.departments.create');
    Route::post('/admin/dipartimenti', [AdminController::class, 'storeDipartimento'])->name('admin.departments.store');
    Route::get('/admin/dipartimenti/{id}', [AdminController::class, 'editDipartimento'])->name('admin.departments.edit');
    Route::put('/admin/dipartimenti/{id}', [AdminController::class, 'updateDipartimento'])->name('admin.departments.update');
    Route::delete('/admin/dipartimenti/{id}', [AdminController::class, 'deleteDipartimento'])->name('admin.departments.delete');

    Route::get('/admin/statistiche', [AdminController::class, 'statistichePrestazioni'])->name('admin.statistics');
});*/

require __DIR__.'/auth.php';
