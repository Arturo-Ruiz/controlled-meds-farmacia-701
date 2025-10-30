<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\DispatchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DrugstoreController;
use App\Http\Controllers\MedicamentTypeController;


Route::middleware('guest')->group(function () {
    Route::redirect('/', 'login', 301);

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login-form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::resource('medicaments', MedicamentController::class);
    Route::resource('laboratories', LaboratoryController::class);

    Route::resource('entries', EntryController::class);
    Route::get('medicaments/{medicament}/data', [EntryController::class, 'getMedicamentData'])->name('medicaments.data');

    Route::resource('dispatches', DispatchController::class);
    Route::get('medicaments/{medicament}/stock-data', [DispatchController::class, 'getMedicamentData'])->name('medicaments.stock-data');

    Route::resource('users', UserController::class);

    Route::resource('drugstores', DrugstoreController::class);
    
    Route::resource('medicament-types', MedicamentTypeController::class);

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
