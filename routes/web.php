<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPrestazioniController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PrenotazioniController;
use App\Http\Controllers\PrestazioneController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminStatisticheController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    Route::get('staff/procedures/{procedure}/schedules/slots-giugno', [StaffController::class, 'getSlot']);
    Route::post('staff/procedures/{procedure}/assign-slot', [StaffController::class, 'assegnaSlot']);
    Route::put('/staff/schedules/{prenotazione}', [StaffController::class, 'updatePrenotazione']);
    Route::delete('staff/procedures/{procedure}/schedules/{prenotazione}', [StaffController::class, 'destroyPrenotazione']);
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
    Route::get('/prestazioni/nuova', [AdminController::class, 'createPrestazione'])->name('prestazioni.create');
    Route::post('/prestazioni', [AdminController::class, 'storePrestazione'])->name('prestazioni.store');
    Route::get('/prestazioni/{id}', [AdminController::class, 'editPrestazione'])->name('prestazioni.edit');
    Route::put('/prestazioni/{id}', [AdminController::class, 'updatePrestazione'])->name('prestazioni.update');
    Route::delete('/prestazioni/{id}', [AdminController::class, 'deletePrestazione'])->name('prestazioni.delete');

    Route::get('/admin/dipartimenti', [AdminController::class, 'dipartimenti'])->name('admin.dipartimenti');
    Route::get('/admin/dipartimenti/nuovo', [AdminController::class, 'createDipartimento'])->name(name: 'admin.dipartimenti.create');
    Route::post('/admin/dipartimenti', [AdminController::class, 'storeDipartimento'])->name('admin.dipartimenti.store');
    Route::get('/admin/dipartimenti/{id}', [AdminController::class, 'editDipartimento'])->name(name: 'admin.dipartimenti.edit');
    Route::put('/admin/dipartimenti/{id}', [AdminController::class, 'updateDipartimento'])->name('admin.dipartimenti.update');
    Route::delete('/admin/dipartimenti/{id}', [AdminController::class, 'deleteDipartimento'])->name('admin.dipartimenti.destroy');
});

require __DIR__.'/auth.php';
