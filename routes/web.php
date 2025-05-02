<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'check.role:admin,user'])->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
});

Route::middleware(['auth', 'check.role:admin,staff'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff');
});

Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});

require __DIR__.'/auth.php';
