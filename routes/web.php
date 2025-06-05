<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index'])->name('home');

Route::middleware(['auth', 'check.role:admin,user'])->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.dashboard');
    Route::get('/customers/profilo', [CustomerController::class, 'editProfilo'])->name('profile.edit');
    Route::post('/customers/profilo', [CustomerController::class, 'updateProfilo'])->name('profile.update');
    Route::delete('/customers/profilo', [CustomerController::class, 'destroyProfilo'])->name('profile.destroy');
    Route::get('/customers/prestazioni', [CustomerController::class, 'prestazioni'])->name(name: 'customers.prestazioni');
    Route::get('/customers/searchPrestazioni', [CustomerController::class, 'searchPrestazione'])->name('customers.prestazioni.search');
    Route::get('/customers/prenotazioni', [CustomerController::class, 'prenotazioni'])->name(name: 'customers.prenotazioni');
    Route::post('/customers/prenotazioni', [CustomerController::class,  'storePrenotazione'])->name('customers.prenotazione.store');
    Route::delete('/customers/prenotazioni/{prenotazione}', [CustomerController::class, 'destroyPrenotazione'])->name('customers.prenotazioni.destroy');
    Route::delete('/customers/notifications/{id}', [CustomerController::class, 'destroyNotification'])->name('customers.notifications.destroy');
});

Route::middleware(['auth', 'check.role:staff'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/prenotazioni', [StaffController::class, 'prenotazioni'])->name('staff.prenotazioni');
    Route::get('/staff/prenotazioni/in-attesa', [StaffController::class, 'prenotazioniInAttesa'])->name('staff.prenotazioni.in-attesa');
    Route::get('staff/procedures/{procedure}/agenda-template', [StaffController::class, 'getTemplate']);
    Route::get('/staff/prenotazioni/{id}', [StaffController::class, 'getSlot']);
    Route::put('/staff/prenotazioni/{id}', [StaffController::class, 'assegnaSlot'])->name(name: 'staff.prenotazioni.assegnaSlot');
    Route::delete('/staff/prenotazioni/{id}', [StaffController::class, 'deletePrenotazione'])->name(name: 'staff.prenotazioni.assegnaSlot');
    Route::get('/staff/prestazioni', [StaffController::class, 'prestazioni']);

});

Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/utenti', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/utenti/nuovo', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/utenti', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/utenti/{id}', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/utenti/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/utenti/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');

    Route::get('/admin/prestazioni', [AdminController::class, 'gestionePrestazioni'])->name('admin.prestazioni');
    Route::get('/admin/prestazioni/nuova', [AdminController::class, 'createPrestazione'])->name('admin.prestazioni.create');
    Route::post('/admin/prestazioni', [AdminController::class, 'storePrestazione'])->name('admin.prestazioni.store');
    Route::get('/admin/prestazioni/{id}', [AdminController::class, 'editPrestazione'])->name('admin.prestazioni.edit');
    Route::put('/admin/prestazioni/{id}', [AdminController::class, 'updatePrestazione'])->name('admin.prestazioni.update');
    Route::delete('/admin/prestazioni/{id}', [AdminController::class, 'deletePrestazione'])->name('admin.prestazioni.delete');

    Route::get('/admin/dipartimenti', [AdminController::class, 'dipartimenti'])->name('admin.dipartimenti');
    Route::get('/admin/dipartimenti/nuovo', [AdminController::class, 'createDipartimento'])->name(name: 'admin.dipartimenti.create');
    Route::post('/admin/dipartimenti', [AdminController::class, 'storeDipartimento'])->name('admin.dipartimenti.store');
    Route::get('/admin/dipartimenti/{id}', [AdminController::class, 'editDipartimento'])->name(name: 'admin.dipartimenti.edit');
    Route::put('/admin/dipartimenti/{id}', [AdminController::class, 'updateDipartimento'])->name('admin.dipartimenti.update');
    Route::delete('/admin/dipartimenti/{id}', [AdminController::class, 'deleteDipartimento'])->name('admin.dipartimenti.destroy');
});

require __DIR__.'/auth.php';
