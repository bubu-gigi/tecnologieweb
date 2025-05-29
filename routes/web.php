<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DipartimentoController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PrenotazioniController;
use App\Http\Controllers\PrestazioneController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfiloController;
use App\Http\Controllers\StaffController;
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

Route::middleware(['auth', 'check.role:user'])->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.dashboard');
    Route::get('/customers/profilo', [ProfiloController::class, 'edit'])->name('profile.edit');
    Route::post('/customers/profilo', [ProfiloController::class, 'update'])->name('profile.update');
    Route::delete('/customers/profilo', [ProfiloController::class, 'destroy'])->name('profile.destroy');
    Route::get('/customers/prestazioni', [CustomerController::class, 'prestazioni'])->name(name: 'customers.prestazioni');
    Route::get('/customers/searchPrestazioni', [PrestazioneController::class, 'search'])->name('customers.prestazioni.search');
    Route::get('/customers/prenotazioni', [CustomerController::class, 'prenotazioni'])->name(name: 'customers.prenotazioni');
    Route::get('/dipartimenti/{id}', [DipartimentoController::class, 'showPage'])->name('customers.dipartimento');
    Route::post('/reservations', [PrenotazioniController::class,  'store'])->name('customers.reservation.store');
});

Route::middleware(['auth', 'check.role:staff'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/prenotazioni', [StaffController::class, 'prenotazioni'])->name('staff.prenotazioni');
    
    Route::get('/staff/prenotazioni/in-attesa', [StaffController::class, 'prenotazioniInAttesa'])->name('staff.prenotazioni.in-attesa');
    Route::get('/staff/prenotazioni/{id}', [StaffController::class, 'dettagliPrenotazione']);
});

Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/utenti', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/utenti/nuovo', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/utenti', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/utenti/{id}', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/utenti/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/utenti/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/dipartimenti', [AdminController::class, 'dipartimenti'])->name('admin.dipartimenti');
    Route::get('/admin/dipartimenti/nuovo', [AdminController::class, 'createDipartimento'])->name(name: 'admin.dipartimenti.create');
    Route::get('/admin/dipartimenti/{id}', [AdminController::class, 'editDipartimento'])->name(name: 'admin.dipartimenti.edit');
    Route::post('/admin/dipartimenti', [AdminController::class, 'storeDipartimento'])->name('admin.dipartimenti.store');
    Route::put('/admin/dipartimenti/{id}', [AdminController::class, 'updateDipartimento'])->name('admin.dipartimenti.update');
    Route::delete('/admin/dipartimenti/{id}', [AdminController::class, 'deleteDipartimento'])->name('admin.dipartimenti.destroy');
});

Route::controller(AgendaController::class)->group(function () {
    Route::get('/procedures/{procedure}/agenda-template', [AgendaController::class, 'getTemplate']);
    Route::get('/procedures/{procedure}/schedules/slots-giugno', [AgendaController::class, 'getSlotDisponibilitaGiugno']);
    Route::get('/procedures/{procedure}/schedules/occupazione-giugno', [AgendaController::class, 'getTabellaOccupazioneGiugno']);
    Route::post('/procedures/{procedure}/assign-slot', [AgendaController::class, 'assegnaSlot']);
    Route::put('/procedures/{procedure}/schedules/{prenotazione}', [AgendaController::class, 'updatePrenotazione']);
    Route::delete('/procedures/{procedure}/schedules/{prenotazione}', [AgendaController::class, 'destroyPrenotazione']);
    Route::get('/procedures/schedules', 'index');
    Route::get('/procedures/{procedure}/schedules', 'show')->name('procedures.schedules.show');
    Route::post('/procedures/{procedure}/schedules', action: 'store')->name('procedures.schedules.save');
    Route::put('/procedures/{procedure}/schedules', 'update');
    Route::delete('/procedures/{procedure}/schedules', 'destroy');
});

require __DIR__.'/auth.php';
