<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DipartimentoController;
use App\Http\Controllers\GuestController;
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

Route::middleware(['auth', 'check.role:admin,user'])->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.dashboard');
    Route::get('/customers/profilo', [ProfiloController::class, 'edit'])->name('profile.edit');
    Route::post('/customers/profilo', [ProfiloController::class, 'update'])->name('profile.update');
    Route::delete('/customers/profilo', [ProfiloController::class, 'destroy'])->name('profile.destroy');
    Route::get('/customers/prestazioni', [CustomerController::class, 'prestazioni'])->name(name: 'customers.prestazioni');
    Route::get('/customers/searchPrestazioni', [PrestazioneController::class, 'search'])->name('customers.prestazioni.search');
    Route::get('/customers/prenotazioni', [CustomerController::class, 'prenotazioni'])->name(name: 'customers.prenotazioni');
    Route::get('/dipartimenti/{id}', [DipartimentoController::class, 'showPage'])->name('customers.dipartimento');
});

Route::middleware(['auth', 'check.role:admin,staff'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');
});

Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/utenti', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/admin/utenti/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/admin/utenti/nuovo', [AdminController::class, 'createUser'])->name(name: 'admin.users.create');
    Route::get('/admin/utenti/{id}', [AdminController::class, 'editUser'])->name(name: 'admin.users.edit');
    Route::get('/admin/dipartimenti', [AdminController::class, 'dipartimenti'])->name('admin.dipartimenti');
    Route::get('/admin/dipartimenti/nuovo', [AdminController::class, 'createDipartimento'])->name(name: 'admin.dipartimenti.create');
    Route::get('/admin/dipartimenti/{id}', [AdminController::class, 'editDipartimento'])->name(name: 'admin.dipartimenti.edit');
});

require __DIR__.'/auth.php';
