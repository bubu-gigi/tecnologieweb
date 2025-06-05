<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GuestController::class, 'index'])->name('home');

Route::middleware(['auth', 'check.role:admin,user'])->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.dashboard');
    Route::get('/customers/profilo', [CustomerController::class, 'editProfilo'])->name('customers.profile.edit');
    Route::post('/customers/profilo', [CustomerController::class, 'updateProfilo'])->name('customers.profile.update');
    Route::delete('/customers/profilo', [CustomerController::class, 'destroyProfilo'])->name('customers.profile.destroy');
    Route::get('/customers/prestazioni', [CustomerController::class, 'prestazioni'])->name('customers.services.index');
    Route::get('/customers/searchPrestazioni', [CustomerController::class, 'searchPrestazione'])->name('customers.services.search');
    Route::get('/customers/prenotazioni', [CustomerController::class, 'prenotazioni'])->name('customers.bookings.index');
    Route::post('/customers/prenotazioni', [CustomerController::class,  'storePrenotazione'])->name('customers.bookings.store');
    Route::delete('/customers/prenotazioni/{prenotazione}', [CustomerController::class, 'deletePrenotazione'])->name('customers.bookings.delete');
    Route::delete('/customers/notifications/{id}', [CustomerController::class, 'deleteNotifica'])->name('customers.notifications.delete');
});

Route::middleware(['auth', 'check.role:staff'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.dashboard');
    Route::get('/staff/prenotazioni', [StaffController::class, 'prenotazioni'])->name('staff.bookings.index');
    Route::get('/staff/prenotazioni/{id}', [StaffController::class, 'getSlot'])->name('staff.bookings.getSlot');
    Route::put('/staff/prenotazioni/{id}', [StaffController::class, 'assegnaSlot'])->name('staff.bookings.assignSlot');
    Route::delete('/staff/prenotazioni/{id}', [StaffController::class, 'deletePrenotazione'])->name('staff.bookings.delete');
    Route::get('/staff/prestazioni', [StaffController::class, 'prestazioni'])->name('staff.services.index');
});

Route::middleware(['auth', 'check.role:admin'])->group(function () {
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
});

require __DIR__.'/auth.php';
