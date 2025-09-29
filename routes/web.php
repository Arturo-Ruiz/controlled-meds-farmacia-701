<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\LaboratoryController;

Route::middleware('guest')->group(function () {
    Route::redirect('/', 'login', 301);

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login-form');
    Route::post('login', [LoginController::class, 'login'])->name('login');
});


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');

    Route::resource('medicaments', MedicamentController::class);  
    Route::resource('laboratories', LaboratoryController::class);  

    

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
